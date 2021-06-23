<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
        'section_name_en',
        'section_name_ar',
        'section_image',
    ]; // end of fillable

    public function product(){
        return $this->belongsToMany('App\Product' ,'section_product' ,'section_id' ,'product_id');
    } // end of many to many relation

}// end of section model
