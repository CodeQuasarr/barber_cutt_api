<?php

namespace App\Http\Resources\Shoping;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return collect([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'category' => $this->category_id,
            'routes' => [
                'self' => route('products.show', $this->id),
                'update' => route('products.update', $this->id),
                'delete' => route('products.destroy', $this->id),
            ],
        ]);
    }
}
