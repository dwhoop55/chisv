<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{

    protected $with = ['timezone', 'state'];


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
        'name', 'key', 'location', 'description',
        'timezone_id', 'start_date', 'end_date',
        'state_id'
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }
}