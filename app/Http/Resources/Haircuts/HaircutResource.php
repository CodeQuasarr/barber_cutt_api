<?php

namespace App\Http\Resources\Haircuts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HaircutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return all collection data of the haircut model
        return collect([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category_id,
        ]);
    }
}
