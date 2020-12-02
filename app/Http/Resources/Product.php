<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // By default toArray will return a blanket response. 
        // If you want to template a specific response then use this.
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
        //     'confirmed' => $this->confirmed,
            'title' => $this->title,
            'mainCategory' => $this->mainCategory,
            'subcategory' => $this->subcategory,
            'description' => $this->description,
            'is_new' => $this->is_new,
            'base_price' => $this->base_price,
            'sale_price' => $this->sale_price,
            'on_sale' => $this->on_sale,
            'types' => json_decode($this->types),
            'operator' => $this->operator,
            'sizes' => json_decode($this->sizes),
            'taggs' => $this->taggs,
            //     'created_at' => $this->created_at,
            //     'updated_at' => $this->updated_at,
        ];
    }
    
    // public function with($request) {
    //     return [
    //         'types' => json_decode($this->types),
    //         'sizes' => json_decode($this->sizes),
    //         // back where I was before. Two options
    //         // Figure out how to return pagination manually
    //         // Or figure out how to respond differently depending on 
    //         // Where the request is comming from
    //         // 'version' => '1.0.0',
    //         // 'author_url' => url('')
    //     ];
    // }
}