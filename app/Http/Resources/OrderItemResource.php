<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
        'order_id' => $this->order_id,
        'product_id' => $this->product_id,
        'quantity' => $this->quantity,
        'price' => $this->price,
        'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

        // optional: include product details
        // 'product' => new ProductResource($this->whenLoaded('product')),
    ];
}

}
