<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Users extends Authenticatable implements MustVerifyEmail
{
    protected $table = "users";

    use Notifiable;


    protected $fillable = [
        'email', 'password', 'firstname', 'lastname', 'address'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $dispatchesEvents = [
    //     'saved' => UserRegisteredEvent::class,
    // ];

    function bills()
    {
        return $this->hasMany('App\Bills', 'user_id', 'id');
    }
}
