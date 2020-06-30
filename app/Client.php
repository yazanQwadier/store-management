<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";
    public $timestamps = false;

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Action(){
        return $this->belongsTo('App\Action');
    }
}
