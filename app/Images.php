<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = "images";

    function products()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
