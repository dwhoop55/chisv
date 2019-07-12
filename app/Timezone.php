<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    public function conferences()
    {
        return $this->hasMany('App\Conference');
    }
}