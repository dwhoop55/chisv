<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{

    protected $with = ['timezone', 'state'];
    protected $guarded = [];

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
}