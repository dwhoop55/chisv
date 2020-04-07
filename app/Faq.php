<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'role_id' => 'integer',
        'keywords' => 'array',
        'view_count' => 'integer',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}