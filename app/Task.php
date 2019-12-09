<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    protected $hidden = ['bids', 'users', 'hide', 'updated_at', 'created_at'];

    public function conference()
    {
        return $this->belongsTo('App\Conference');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Bid', 'task_id', 'id', 'id', 'user_id');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }
}