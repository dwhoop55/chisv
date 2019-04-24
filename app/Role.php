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

    public static function byKey($key)
    {
        return Role::where('key', $key)->first();
    }
}
