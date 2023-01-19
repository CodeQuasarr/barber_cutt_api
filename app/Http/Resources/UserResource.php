<?php

namespace App\Http\Resources;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return collect([
            'id' => $this->id,
            'full_name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'sexe' => $this->sexe,
            'email' => $this->email,
            'instance' => $this->instance?->getName(),
            'role' => Role::getDescriptionByName($this->getRoleNames()->first()),
            'his_manager' => $this->manager?->getName(),
            'confirmed' => $this->hasVerifiedEmail(),
            'contract_start_date' => $this->contract_start_date,
            'birthday' => [
                'date' => $this->birthday,
                'age' => Carbon::parse($this->birthday)->age,
            ],
            'phone' => $this->phone,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'address_num' => $this->address_num,
            'nationality' => $this->nationality,
            'routes' => [
                'self' => route('users.show', $this->id),
                'update' => route('users.update', $this->id),
                'delete' => route('users.destroy', $this->id),
            ],
        ]);
    }
}
