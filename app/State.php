<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;
    //

    public static function byName($name)
    {
        return State::where('name', $name)->first();
    }
}
