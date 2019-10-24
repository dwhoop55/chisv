<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentForm extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function permission()
    {
        return $this->hasOne('App\Permission');
    }

    public function conferences()
    {
        return $this->hasMany('App\Conference');
    }
}