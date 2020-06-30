<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public $timestamps = false;

    public function Category(){
        return $this->belongsTo('App\Category');
    }

    public function Action(){
        return $this->belongsTo('App\Action');
    }
}
