<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = "actions";
    public $timestamps = false;

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Client(){
        return $this->hasOne('App\Client');
    }

    public function Product(){
        return $this->hasMany('App\Product');
    }

}
