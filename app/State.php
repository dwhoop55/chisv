<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    public static function byName($name)
    {
        return State::where('name', $name)->first();
    }

    public function conferences()
    {
        return $this->hasMany('App\Conference');
    }

    public function users()
    {
        return $this->hasMany('App\Conference');
    }

    public function isFor($class)
    {
        return app($this->for) == app($class);
    }
}