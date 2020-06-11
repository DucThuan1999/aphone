<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    protected $table = "promotions";

    function products()
    {
        return $this->belongsToMany('App\Products', 'promotions_products', 'promotion_id', 'product_id')->withPivot(['percent', 'type_discount', 'price_discount']);
    }
}
