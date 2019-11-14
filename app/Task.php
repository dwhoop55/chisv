<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];

    public function conference()
    {
        return $this->belongsTo('App\Task');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Bid', 'task_id', 'id', 'id', 'user_id');
    }

    // public function getAccountedHoursAttribute()
    // {
    //     if ($this->override_hours) {
    //         return $this->override_hours;
    //     } else {
    //         $start = Carbon::parse($this->start_at);
    //         $end = Carbon::parse($this->end_at);
    //         return $start->diffInHours($end);
    //     }
    // }
}