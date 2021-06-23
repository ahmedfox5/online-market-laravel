<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    protected $fillable = [
        'product_id' ,
        'user_id' ,
        'approved' ,
        'quantity' ,
    ] ;
}
