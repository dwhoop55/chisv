<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    // protected $with = ['state'];
    protected $guarded = [];
    protected $casts = [
        'user_id' => 'int',
        'task_id' => 'int',
        'state_id' => 'int',
        'hours' => 'float'
    ];

    public function notes()
    {
        return $this->morphMany('App\Note', 'for');
    }

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

    public function bid()
    {
        return Bid
            ::where([
                'user_id' => $this->user_id,
                'task_id' => $this->task->id
            ])
            ->first();
    }
}