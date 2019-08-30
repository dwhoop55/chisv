<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $with = ['role', 'user', 'conference', 'state', 'enrollmentInfo'];
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

    public function enrollmentInfo()
    {
        return $this->hasOne('App\EnrollmentInfo');
    }
}