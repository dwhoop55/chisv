<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $with = [];
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Gets the number of assignments at a given time
     * 
     * @param Task|Carbon $a First argument can be a Task or Carbon object
     * @param Carbon|null $b Second argument has to be null when first is Task or Carbon when first is Carbon 
     */
    public function tasksAtTime($a, $b = null)
    {
        if ($a instanceof Task && !$b) {
            $startDateTime = Carbon::createFromDateAndTime($a->date, $a->start_at);
            $endDateTime = Carbon::createFromDateAndTime($a->date, $a->end_at);
        } else if ($a instanceof Carbon && $b instanceof Carbon) {
            $startDateTime = $a;
            $endDateTime = $b;
        } else {
            throw new Exception("Method call of isAvailable not possible with these arguments");
        }

        $day = $startDateTime->copy()->startOfDay();
        $start = $startDateTime->format('H:i:s');
        $end = $endDateTime->format('H:i:s');

        // There are many ways to do this. To offload as much computation
        // to the database we will fetch all tasks for the timespan,
        // then check is the user is assigned to them. We cannot do the
        // same while fetching assignments with $user->assignments, since
        // this will give us all assignents the user every was assgined to
        // and we will still have to query the task every time since assignment
        // has no time, only the task. So let's limit this from the beginning
        // and just fetch all tasks. That should be less in any case

        // SQL query looks like  WHERE date=? AND ( [1] OR [2] OR [3] )
        $tasks = Task
            ::with('assignments')
            // date=?
            ->where('date', $day)
            ->where(function ($query) use ($start, $end) {
                // [1]
                $query->where(function ($query) use ($start, $end) {
                    $query->where('start_at', '>=', $start);
                    $query->where('start_at', '<=', $end);
                });
                // [2]
                $query->orWhere(function ($query) use ($start, $end) {
                    $query->where('end_at', '>=', $start);
                    $query->where('end_at', '<=', $end);
                });
                // [3]
                $query->orWhere(function ($query) use ($start, $end) {
                    $query->where('start_at', '<=', $start);
                    $query->where('end_at', '>=', $end);
                });
            })
            ->get();

        // Now we check for availablity
        $tasks = $tasks->filter(function ($task) {
            // Filter out the assignment if there is any for the user
            $task->assignments = $task->assignments->filter(function ($assignment) {
                return $assignment->user_id == $this->id;
            });
            // When the assignments collection is not empty that means
            // that there is an assignment for the user for this task
            return $task->assignments->isNotEmpty();
        });

        // Return all active tasks at this time period
        return $tasks->map(function ($task) {
            return $task->only(['id', 'name', 'start_at', 'end_at']);
        })->values();
    }

    public function assignmentFor(Task $task)
    {
        return Assignment
            ::where('user_id', $this->id)
            ->where('task_id', $task->id)
            ->first();
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }

    /**
     * 
     * @param Task $task Task the bid requested is for
     * @return Bid|null The requested bid or null
     * 
     */
    public function bidFor(Task $task)
    {
        return Bid::where(['task_id' => $task->id, 'user_id' => $this->id])->first();
    }

    public function bidsFor(Conference $conference, State $state = null, $preference = null)
    {
        $bids = $this->bids()->with('task', 'task.conference', 'state')->get()->filter(function ($bid) use ($conference, $state, $preference) {
            if ($state) {
                if ($preference !== null) {
                    return $bid->task->conference->id == $conference->id
                        && $bid->state->id == $state->id
                        && $bid->preference == $preference;
                } else {
                    return $bid->task->conference->id == $conference->id && $bid->state->id == $state->id;
                }
            } else {
                if ($preference !== null) {
                    return $bid->task->conference->id == $conference->id
                        && $bid->preference == $preference;
                } else {
                    return $bid->task->conference->id == $conference->id;
                }
            }
        });
        return $bids;
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function conferencesAsChairOrCaptain()
    {
        return $this->conferencesByRole(Role::byName('chair'))
            ->merge($this->conferencesByRole(Role::byName('captain')));
    }

    public function conferencesByRole(Role $role)
    {
        return $this->hasManyThrough('App\Conference', 'App\Permission', 'user_id', 'id', 'id', 'conference_id')->where('role_id', $role->id)->get();
    }

    public function conferences()
    {
        return $this->hasManyThrough('App\Conference', 'App\Permission', 'user_id', 'id', 'id', 'conference_id');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }

    public function degree()
    {
        return $this->belongsTo('App\Degree');
    }

    public function shirt()
    {
        return $this->belongsTo('App\Shirt');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function university()
    {
        // TODO: add fallback case for no id attached
        return $this->belongsTo('App\University');
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }

    public function avatar()
    {
        return $this->morphOne('App\Image', 'owner')->orderBy('updated_at', 'DESC');
    }

    public function isAdmin()
    {
        return $this->hasPermission(Role::byName('admin'));
    }

    public function isChair(Conference $conference = null)
    {
        return $this->hasPermission(Role::byName('chair'), $conference);
    }

    public function isCaptain(Conference $conference = null)
    {
        return $this->hasPermission(Role::byName('captain'), $conference);
    }

    public function isSv(Conference $conference = null, State $state = null)
    {
        return $this->hasPermission(Role::byName('sv'), $conference, $state);
    }

    public function grant(Role $role, Conference $conference, State $state = null, EnrollmentForm $enrollmentForm = null)
    {
        $permission = new Permission;
        $permission->user()->associate($this);
        $permission->role()->associate($role);
        $permission->conference()->associate($conference);
        $permission->state()->associate($state);

        try {
            $permission->save();
            // Now that we have the model id-ed in the database
            // we can save the enrollmentForm when available
            if ($enrollmentForm) {
                $permission->enrollmentForm()->associate($enrollmentForm);
                $permission->save();
            }
            return $permission;
        } catch (QueryException $th) {
            return null;
        }
    }

    public function revoke(Role $role, Conference $conference)
    {
        // We can call first() here because the can only be one row
        // from the query, since we defined the columns to be unique
        $permission = $this->permissions
            ->where('role_id', $role->id)
            ->where('conference_id', $conference->id)
            ->first();

        if ($permission) {
            try {
                return $permission->delete();
            } catch (QueryException $th) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function hasPermission(Role $role, Conference $conference = null, State $state = null)
    {
        if ($conference) {
            if ($state) {
                return $this->permissions
                    ->where('role_id', $role->id)
                    ->where('conference_id', $conference->id)
                    ->where('state_id', $state->id)
                    ->isNotEmpty();
            } else {
                return $this->permissions
                    ->where('role_id', $role->id)
                    ->where('conference_id', $conference->id)
                    ->isNotEmpty();
            }
        } else {
            if ($state) {
                return $this->permissions
                    ->where('role_id', $role->id)
                    ->where('state_id', $state->id)
                    ->isNotEmpty();
            } else {
                return $this->permissions
                    ->where('role_id', $role->id)
                    ->isNotEmpty();
            }
        }
    }

    public function svStateFor(Conference $conference)
    {
        $permission = $this->permissions()
            ->where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        return $permission ? $permission->state : null;
    }

    public function svPermissionFor(Conference $conference)
    {
        $permission = $this->permissions()
            ->where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        return $permission ? $permission : null;
    }

    public function setSvStateFor(State $state, Conference $conference)
    {
        $permission = $this->permissions()
            ->where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        if ($permission) {
            return $permission->update(['state_id' => $state->id]);
        } else {
            return false;
        }
    }

    public function hoursFor(Conference $conference, State $state = null)
    {
        $hours = 0.0;

        if (!$state) {
            $state = State::byName('done', 'App\Assignment');
        }

        // First we filter for the conference
        $assignments = $this->assignments()
            // only for the specific conference
            ->whereHas('task', function ($query) use ($conference) {
                $query->where('conference_id', '=', $conference->id);
            })
            // only assignments which are in the requested state
            ->where('state_id', $state->id)
            ->get();

        // Now we sum up all the hours
        $assignments->each(function ($assignment) use (&$hours) {
            $hours += $assignment->hours;
        });

        return round($hours, 2);
    }

    public function toTimezone($date)
    {
        $timezone = $this->timezone;
        $carbonDate = new Carbon($date);
        $carbonDate->timezone = $timezone->name;
        return $carbonDate;
    }

    public function formatDate($date, $format = null)
    {
        if (!$format) {
            $format = $this->date_format . ' ' . $this->time_format;
        }
        return $this->toTimezone($date)->format($format);
    }
}