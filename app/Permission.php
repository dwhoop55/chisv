<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /** 
     * Ensure some attributes are casted correctly as int
     * They end up as string in the frontend which destroys sorting
     */
    protected $casts = [
        'lottery_position' => 'integer',
    ];

    protected $with = ['role', 'user', 'conference', 'state', 'enrollmentForm'];
    protected $hidden = ['role_id', 'user_id', 'conference_id', 'state_id', 'enrollment_form_id'];
    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function conference()
    {
        return $this->belongsTo('App\Conference');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function enrollmentForm()
    {
        return $this->belongsTo('App\EnrollmentForm');
    }
}