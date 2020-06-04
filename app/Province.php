<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "province";

    function district()
    {
        return $this->hasMany('App\District', '_province_id', 'id');
    }

    function ward()
    {
        return $this->hasMany('App\Ward', '_province_id', 'id');
    }

    function address()
    {
        return $this->belongsTo('App\Address', 'id', 'id');
    }
}
