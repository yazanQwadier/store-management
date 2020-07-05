<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = "actions";
    public $timestamps = false;

    protected $fillable = [
        'type', 'company_id', 'client_name','product_name', 'price', 'quantity', 'date','notes',
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
