<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = "colors";

    function products()
    {
        return $this->belongsToMany('App\Products', 'colors_products', 'color_id', 'product_id');
    }
}
