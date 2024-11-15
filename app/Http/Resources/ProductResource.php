<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'company' => $this->company,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
            'images' => $this->images, // Assuming images are stored as URLs or paths
            'expiration_date' => $this->expiration_date,
            'ingredients' => $this->ingredients,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
