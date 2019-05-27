<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
}