<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this-> id,
            'product_name_en' => $this-> product_name_en,
            'product_name_ar' => $this-> product_name_ar,
            'product_desc_en' => $this-> product_desc_en,
            'product_desc_ar' => $this-> product_desc_ar,
            'section_id' => $this-> section_id,
            'priority' => $this-> priority,
            'price' => $this-> price,
            'user_id' => $this-> user_id,
            'discount_present' => $this-> discount_present,
            'after_discount' => $this-> after_discount,
            'number_of_sell' => $this-> number_of_sell,
        ];
    }
}
