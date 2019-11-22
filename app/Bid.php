<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $with = ['state'];
    protected $guarded = [];
    protected $casts = [
        'preference' => 'integer',
        'state_id' => 'integer',
        'user_id' => 'integer',
        'conference_id' => 'integer',
        'task_id' => 'integer',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}