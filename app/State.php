<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    /**
     * Get a state by name.
     * 
     * @param string $name State's name
     * @param string $for e.g 'App\User'
     * @return State The requested state from database 
     */
    public static function byName($name, $for = null)
    {
        if ($for) {
            return State::where('name', $name)->where('for', $for)->orderBy('id')->first();
        } else {
            return State::where('name', $name)->orderBy('id')->first();
        }
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