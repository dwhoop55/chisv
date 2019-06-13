<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $visible = ['id', 'name'];

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function location()
    {
        $location = new Location;
        $location->city = $this;
        $location->country = $this->country;
        $location->region = $this->region;

        return $location;
    }
}