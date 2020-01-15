<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    protected $hidden = ['users', 'hide', 'updated_at', 'created_at'];

    /**
     * @return int Returns the number of free slots but at least 0
     */
    public function freeSlots()
    {
        $freeSlots = $this->slots - $this->assignments->count();
        return $freeSlots < 0 ? 0 : $freeSlots;
    }

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