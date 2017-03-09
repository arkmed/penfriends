<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function experiences() {
        return $this->hasMany('App\Experience');
    }


}
