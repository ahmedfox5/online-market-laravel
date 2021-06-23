<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'first_name', 'email', 'password','last_name' ,'job' ,'img_name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products(){
        return $this->hasMany('App\Product' ,'user_id');
    }

    public function likes(){
        return $this->hasMany('App\Like' ,'user_id');
    }

    public function cart(){
        return $this->hasMany('App\Shoppingcart' ,'user_id');
    }
}
