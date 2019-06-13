<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $visible = ['id', 'name'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function regions()
    {
        return $this->hasMany('App\Region');
    }

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}