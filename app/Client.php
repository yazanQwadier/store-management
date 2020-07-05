<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";
    public $timestamps = false;
    public $fillable = ['company_id' , 'name' , 'phone' , 'section'];

    public function User(){
        return $this->belongsTo('App\User');
    }

}
