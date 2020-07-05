<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public $timestamps = false;
    public $fillable = ['cate_id' , 'company_id' , 'name' , 'price' , 'quantity' , 'img'];

    public function Category(){
        return $this->belongsTo('App\Category');
    }

}
