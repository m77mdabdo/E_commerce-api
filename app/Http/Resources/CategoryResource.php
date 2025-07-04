<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "category_id" => $this->id,
            "category_name" => $this->name,
            "category_desc" => $this->desc,
            "category_image" => asset("storage" . "/" . $this->image),
            "category_status" => $this->status,



        ];
    }
}
