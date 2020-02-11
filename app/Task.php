<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use PDO;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    protected $hidden = ['users', 'hide', 'updated_at', 'created_at'];
    protected $casts = ['hours' => 'float', 'slots' => 'int', 'priority' => 'int'];

    /**
     * Assigns a User to a Task by creating a new Assignment
     * 
     * @param User The User which should be assigned
     * @return Assignment|null The created Assignment or null when already assigned
     */
    public function assign(User $sv)
    {
        $assignment = new Assignment([
            'user_id' => $sv->id,
            'task_id' => $this->id,
            'hours' => $this->hours
        ]);

        try {
            $assignment->save();
        } catch (QueryException $e) {
            return null;
        } catch (Exception $e) {
            throw $e;
        }
        $assignment->refresh();
        return $assignment;
    }

    /** 
     * Check if this task is conflicting with a collection of other
     * Tasks
     * 
     * @param Collection<Task> $tasks A Collection if Task models to test
     * @return boolean true if a conflict is found, false if not
     */
    public function isConflicting(Collection $tasks)
    {
        $found = false;
        foreach ($tasks as $currentTask) {
            // First ensure that all the values are not null
            if (
                !$this->date ||
                !$this->start_at ||
                !$this->end_at ||
                !$currentTask->date ||
                !$currentTask->start_at ||
                !$currentTask->end_at
            ) {
                throw new Exception("Task has date/time attributes null!", 1);
            }
            // First we test the day
            if ($this->date == $currentTask->date) {
                $thisTaskStart = Carbon::create($this->start_at);
                $thisTaskEnd = Carbon::create($this->end_at);
                $currentTaskStart = Carbon::create($currentTask->start_at);
                $currentTaskEnd = Carbon::create($currentTask->end_at);

                // Now we need to check the time
                //  <   = this task start
                //  >   = this task end
                //  {   = current task start
                //  }   = current task end
                // [1] <  {     }   >
                // [2]    {  <  }  
                // [3]    {  >  }  
                if (
                    // [1]
                    ($thisTaskStart <= $currentTaskStart) && ($thisTaskEnd >= $currentTaskEnd) ||
                    // [2]
                    ($thisTaskStart >= $currentTaskStart) && ($thisTaskStart <= $currentTaskEnd) ||
                    // [3]
                    ($thisTaskEnd >= $currentTaskStart) && ($thisTaskEnd <= $currentTaskEnd)
                ) {
                    // We found at least one conflict
                    // no need to check the rest. Mark
                    // as found and break
                    $found = true;
                    break;
                } // time conflict
            } // same day
        } // foreach
        return $found;
    }

    /**
     * @return int Returns the number of free slots but at least 0
     */
    public function freeSlots()
    {
        $freeSlots = $this->slots - $this->assignments->count();
        return $freeSlots < 0 ? 0 : $freeSlots;
    }

    public function conference()
    {
        return $this->belongsTo('App\Conference');
    }

    public function usersWithBid()
    {
        return $this->hasManyThrough('App\User', 'App\Bid', 'task_id', 'id', 'id', 'user_id');
    }

    public function usersWithAssignment()
    {
        return $this->hasManyThrough('App\User', 'App\Assignment', 'task_id', 'id', 'id', 'user_id');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }
}