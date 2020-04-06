<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $casts = [
        'role_id' => 'integer',
        'keywords' => 'array',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}