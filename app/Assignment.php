<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $with = ['state'];
    protected $guarded = [];
    protected $casts = [
        'user_id' => 'int',
        'task_id' => 'int',
        'state_id' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}