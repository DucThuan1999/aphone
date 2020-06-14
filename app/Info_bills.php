<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_bills extends Model
{
    protected $table = "info_bills";

    function product()
    {
        return $this->belongsTo('App\Products', 'product_id', 'id');
    }

    function bill()
    {
        return $this->belongsTo('App\Bills', 'bill_id', 'id');
    }

    function color()
    {
        return $this->belongsTo('App\Colors', 'color_id', 'id');
    }
}
