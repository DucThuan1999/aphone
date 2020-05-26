<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlist';

    function products()
    {
        return $this->belongsTo('App\Products', 'product_id', 'id');
    }

    function users()
    {
        return $this->belongsTo('App\Users', 'user_id', 'id');
    }
}
