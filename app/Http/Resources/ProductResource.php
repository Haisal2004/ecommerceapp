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
public function toArray($request)
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'subcategory' => $this->whenLoaded('subcategory', function () {
            return new SubcategoryResource($this->subcategory);
        }),
        'category' => $this->whenLoaded('subcategory.category', function () {
            return new CategoryResource($this->subcategory->category);
        }),
        'price' => $this->price,
        'stock' => $this->stock,
    ];
}


}
