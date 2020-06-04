<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = "ward";

    function district()
    {
        return $this->belongsTo('App\District', '_district_id', 'id');
    }

    function province()
    {
        return $this->belongsTo('App\Provice', '_province_id', 'id');
    }

    function address()
    {
        return $this->belongsTo('App\Address', 'id', 'id');
    }
}
