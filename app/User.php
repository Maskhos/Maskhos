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
        'uspicture','password','usname','usbirthDate','country_id','usadmin','userased','ustwitter','usinstagram','faction_id','ustumblr','usdesc','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     'created_at','updated_at','remember_token'
    ];
}
