<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $table = "followers";
    protected $fillable = ['email'];
    public $timestamps = false;
}
