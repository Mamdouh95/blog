<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'national_id', 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Gender value to be saved in Db ( Change value of key to change it )
     *
     * @var array
     */
    protected $gender = [
        'male' => 'male',
        'female' => 'female'
    ];

    // <--- Accessors and Mutators -->

    // <--- Relations --->

}
