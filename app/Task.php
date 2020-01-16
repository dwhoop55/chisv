<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    protected $hidden = ['users', 'hide', 'updated_at', 'created_at'];

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

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Bid', 'task_id', 'id', 'id', 'user_id');
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