<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_id" => $this->id,
            "product_name" => $this->name,
            "product_desc" => $this->desc,
            "product_price" => $this->price,
            "product_image" =>  asset("storage" . "/" . $this->image),
            "product_quantity" => $this->quantity,
            "product_category_id" => $this->category_id,

        ];
    }
}
