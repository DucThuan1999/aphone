<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = "suppliers";

    function product()
    {
        return $this->hasMany('App\Products', 'supplier_id', 'id');
    }
}
