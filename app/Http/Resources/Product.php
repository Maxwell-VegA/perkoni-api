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
        // respond differently depending on who is making the request
        // return isConfirmed and toBeDeleted only to vendors
        return [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'isPublic' => $this->isPublic,
            // 'isConfirmed' => $this->isConfirmed,
            // 'toBeDeleted' => $this->toBeDeleted,
            'title' => $this->title,
            'mainCategory' => $this->mainCategory,
            'subcategory' => $this->subcategory,
            'description' => $this->description,
            'is_new' => $this->is_new,
            'base_price' => $this->base_price,
            'sale_price' => $this->sale_price,
            'on_sale' => $this->on_sale,
            'operatorIsMultiply' => $this->operatorIsMultiply,
            'types' => json_decode($this->types),
            'sizes' => json_decode($this->sizes),
            'taggs' => json_decode($this->taggs),
            'gender' => $this->gender,
            'images' => json_decode($this->images),
            'related' => json_decode($this->images),
            // 'user_username' => $this->brand->user->id,
            'brand_logo' => $this->brand->logo,
            'brand_name' => $this->brand->name,
            'brand_description' => $this->brand->description,
            'brand_facebook' => $this->brand->facebook,
            'brand_instagram' => $this->brand->instagram,
            // 'user' => $this->user->class,
            // 'created_at' => $this->created_at,
            //     'updated_at' => $this->updated_at,
        ];
    }
}