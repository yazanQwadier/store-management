<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    public $timestamps = false;
    public $fillable = ['id' , 'name' , 'company_id' , 'description'];


    public function Product(){
        return $this->hasMany('App\Product');
    }

    public function User(){
        return $this->belongsTo('App\User');
    }

}
