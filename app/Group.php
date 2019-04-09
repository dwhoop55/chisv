<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;

    /**
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}