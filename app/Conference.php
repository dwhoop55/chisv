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
        return 'key';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key', 'location', 'description', 'date'
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}