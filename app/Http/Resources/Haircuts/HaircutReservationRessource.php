<?php

namespace App\Http\Resources\Haircuts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class HaircutReservationRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return collect([
            'id' => $this->id,
            'haircut_id' => $this->haircut_id,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'status' => $this->status,
        ]);
    }
}
