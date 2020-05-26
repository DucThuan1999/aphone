<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";

    function info_products()
    {
        return $this->hasOne('App\Info_products', 'product_id', 'id');
    }
    function images()
    {
        return $this->hasMany('App\Images', 'product_id', 'id');
    }

    function categories()
    {
        return $this->belongsTo('App\Categories', 'category_id', 'id');
    }

    function suppliers()
    {
        return $this->belongsTo('App\Suppliers', 'supplier_id', 'id');
    }

    function bills()
    {
        return $this->belongsToMany('App\Bills', 'info_bills', 'product_id', 'bill_id');
    }

    function colors()
    {
        return $this->belongsToMany('App\Colors', 'colors_products', 'product_id', 'color_id');
    }

    function wishlist()
    {
        return $this->hasMany('App\WishList', 'user_id', 'id');
    }
}
