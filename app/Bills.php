<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $table = "bills";

    function product(){
        return $this->belongsToMany('App\Products','info_bills','bill_id','product_id');
    }

    function users(){
        return $this->belongsTo('App\Users','user_id','id');
    }
}
