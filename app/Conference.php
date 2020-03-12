<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conference extends Model
{

    protected $with = [];

    // We guard there properties, such that they don't get assigned
    // when we mass-update the conference with an request
    protected $guarded = ['icon', 'image'];
    protected $casts = [
        'bidding_enabled' => 'boolean',
        'enrollment_form_id' => 'int',
        'state_id' => 'int',
        'timezone_id' => 'int',
        'volunteer_hours' => 'int',
        'volunteer_max' => 'int',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'key';
    }

    public function enrollmentFormTemplate()
    {
        return $this->belongsTo('App\EnrollmentForm', 'enrollment_form_id');
    }

    public function filledEnrollmentForms()
    {
        return $this->hasManyThrough('App\EnrollmentForm', 'App\Permission', 'conference_id', 'id', 'id', 'enrollment_form_id');
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }

    public function artwork()
    {
        return $this->morphOne('App\Image', 'owner')->orderBy('updated_at', 'DESC')->where('type', '=', 'artwork');
    }

    public function icon()
    {
        return $this->morphOne('App\Image', 'owner')->orderBy('updated_at', 'DESC')->where('type', '=', 'icon');;
    }

    public function users(Role $role = null)
    {
        if (!$role) {
            return $this->hasManyThrough('App\User', 'App\Permission', 'conference_id', 'id', 'id', 'user_id');
        } else {
            return $this->hasManyThrough('App\User', 'App\Permission', 'conference_id', 'id', 'id', 'user_id')->where('role_id', '=', $role->id);
        }
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function assignments()
    {
        return $this->hasManyThrough('App\Assignment', 'App\Task', 'conference_id', 'task_id', 'id', 'id');
    }

    public function bids()
    {
        return $this->hasManyThrough('App\Bid', 'App\Task', 'conference_id', 'task_id', 'id', 'id');
    }
}