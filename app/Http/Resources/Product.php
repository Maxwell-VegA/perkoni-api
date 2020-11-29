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
        return parent::toArray($request);
        // By default toArray will return a blanket response. 
        // If you want to template a specific response then use this.
        // return [
        //     'id' => $this->id,
        //     'user_id' => $this->user_id,
        //     'confirmed' => $this->confirmed,
        //     'title' => $this->title,
        //     'base_price' => $this->base_price,
        //     'category' => $this->category,
        //     'description' => $this->description,
        //     'taggs' => $this->taggs,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('')
            // 'author_url' => url('http://traversymedia.com')
        ];
    }
}