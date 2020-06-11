<?php

namespace App;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class Products extends Model implements Buyable
{
    protected $table = "products";

    protected $fillable = [
        'qty'
    ];

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableWeight($options = null)
    {
        return 0;
    }

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
        return $this->belongsToMany('App\Colors', 'colors_products', 'product_id', 'color_id')->withPivot('quantity');
    }

    function promotions()
    {
        return $this->belongsToMany('App\Promotions', 'promotions_products', 'product_id', 'promotion_id')->withPivot(['percent', 'type_discount', 'price_discount']);
    }

    function wishlist()
    {
        return $this->hasMany('App\WishList', 'user_id', 'id');
    }
}
