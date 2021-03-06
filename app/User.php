<?php

namespace sispes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
     protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login','name', 'email', 'password','plantD','plantA','rol',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
