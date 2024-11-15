<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $this->product->name ?? 'N/A', // Assuming relationship to get the product name
            'quantity' => $this->quantity,
            'price' => $this->product->price ?? 0,           // Price from the product model
            'total_price' => $this->quantity * ($this->product->price ?? 0), // Calculated total price
        ];    }
}
