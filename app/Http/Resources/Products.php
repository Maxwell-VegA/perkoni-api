<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{
    public function toArray($request)
    {
       return [
            'id' => $this->id,
            'title' => $this->title,
            'base_price' => $this->base_price,
            'sale_price' => $this->when($this->on_sale, $this->sale_price),
            // 'sale_price' => $this->when(!$this->on_sale, $this->base_price),
            // 'sale_price' => $this->sale_price,
            'on_sale' => $this->when($this->on_sale, $this->on_sale),
            'taggs' => json_decode($this->taggs),
            'images' => json_decode($this->images),
            'hover' => false,
            'interval' => 3000,
            'cPage' => 1,
       ];
    }
}