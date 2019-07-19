<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    /**
     * Get the owning imageable model.
     */
    public function owner()
    {
        return $this->morphTo();
    }
}