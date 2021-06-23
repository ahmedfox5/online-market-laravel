<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $hidden = ['created_at' , 'updated_at'];

    protected $fillable = [
        'product_name_en',
        'product_name_ar',
        'product_desc_en',
        'product_desc_ar',
        'price',
        'discount_present',
        'after_discount',
        'number_of_sell',
    ];

    public function section(){
        return $this->belongsToMany('App\Section','section_product' ,'product_id' ,'section_id');
    }

    public function images(){
        return $this->hasMany('\App\Image' , 'product_id');
    }

    public function comments(){
        return $this->hasMany('\App\Comment' ,'product_id');
    }

    public function user(){
        return $this->belongsTo('\App\User' ,'user_id');
    }

}
