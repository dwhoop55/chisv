<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{

    protected $with = ['timezone', 'state'];

    // We guard there properties, such that they don't get assigned
    // when we mass-update the conference with an request
    protected $guarded = ['icon', 'image'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'key';
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function icon()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}