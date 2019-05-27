<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
}