<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'permissions')->as('permission');
    }

    public static function byName($name)
    {
        return Role::where('name', $name)->first();
    }
}
