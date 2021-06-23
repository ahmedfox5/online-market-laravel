<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class sectionsResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id ,
            'section_name_en' => $this->section_name_en ,
            'section_name_ar' => $this->section_name_ar ,
            'section_image' => $this->section_image
        ];
    }
}
