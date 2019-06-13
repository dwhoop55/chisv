<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $visible = ['id', 'name'];

    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}