<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\Products');
    }

    public function quantity(){
        return $this->hasMany('App\OrderItems');
    }
}
