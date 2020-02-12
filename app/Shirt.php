<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}