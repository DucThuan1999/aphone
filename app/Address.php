<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "address";

    function district()
    {
        return $this->hasMany('App\District', 'id', 'district_id');
    }

    function ward()
    {
        return $this->hasMany('App\Ward', 'id', 'ward_id');
    }

    function province()
    {
        return $this->hasMany('App\Province', 'id', 'province_id');
    }
}
