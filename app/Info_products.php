<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_products extends Model
{
    protected $table = "info_products";

    function products()
    {
        return $this->belongsTo('App\Products', 'id');
    }
}
