<?php

namespace Attract\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getName1Attribute($value)
    {
        
    }

    // user has many posts
    public function news()
    {
        return $this->hasMany('Attract\Models\News','user_id');
    }
}

