<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'location', 'description', 'date'
    ];

    
}
