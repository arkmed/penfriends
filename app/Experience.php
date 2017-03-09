<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    protected $fillable = ['reply', 'user_email'];

    public function product() {
        return $this->belongsTo('App\Product');
    }



}
