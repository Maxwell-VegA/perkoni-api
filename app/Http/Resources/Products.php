<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{
    public function toArray($request)
    {

        return parent::toArray($request);
    //    return [
    //         'title' => $this->title
    //    ];
    }
}