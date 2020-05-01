<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];
    protected $casts = [
        'creator_id' => 'int',
        'for_id' => 'int',
    ];

    public function for()
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }
}