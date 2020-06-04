<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "district";

    function province()
    {
        return $this->belongsTo('App\Province', '_province_id', 'id');
    }

    function ward()
    {
        return $this->hasMany('App\Ward', '_ward_id', 'id');
    }

    function address()
    {
        return $this->belongsTo('App\Address', 'id', 'id');
    }
}
