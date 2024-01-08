<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"        => $this->id,
            "name"      => $this->name,
            "email"     => $this->email,           
            'phone'     => $this->phone,
            'address'   => $this->address,
            'city'      => $this->city,
            'state'     => $this->state,
            'postalCode' => $this->postal_code,
            'country'   => $this->country,
            'avatar'    => $this->getFirstMediaUrl('avatar', 'avatar'),
            "status"    => $this->status ? "active" : "in-active",
            'role'      => $this->role->name,
        ];
    }
}
