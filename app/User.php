<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'first_name',
        'email',
        'password',
        'birthdate',
        'gender',
        'address',
        'shipping_address',
        'phone',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function order()
    {
        return $this->hasMany('App\Order', 'user_id');
    }
}
