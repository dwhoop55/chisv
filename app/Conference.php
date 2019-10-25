<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conference extends Model
{

    protected $with = ['timezone', 'state', 'artwork', 'icon'];

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

    public function enrollmentForm()
    {
        return $this->belongsTo('App\EnrollmentForm');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }

    public function artwork()
    {
        return $this->morphOne('App\Image', 'owner')->orderBy('updated_at', 'DESC')->where('type', '=', 'artwork');
    }

    public function icon()
    {
        return $this->morphOne('App\Image', 'owner')->orderBy('updated_at', 'DESC')->where('type', '=', 'icon');;
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Permission', 'conference_id', 'id', 'id', 'user_id');
    }
}