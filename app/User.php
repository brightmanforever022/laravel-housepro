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
        'company',
        'name',
        'surname',
        'phone',
        'email',
        'address',
        'city',
        'zipcode',
        'password',
        'user_type',
        'active',
        'hash_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function account()
    {
        return $this->hasOne('App\Account');
    }

    public function property()
    {
        return $this->hasMany('App\Property');
    }

    public function message()
    {
        return $this->hasMany('App\Message','owner_id');
    }

    
}
