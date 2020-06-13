<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";
    protected $fillable = ['user_id', 'product_id', 'content', 'user_rate'];
    public $timestamps = false;

    function users()
    {
        return $this->hasMany('App\Users', 'id', 'user_id');
    }
    function products()
    {
        return $this->hasMany('App\Products', 'id', 'product_id');
    }
}
