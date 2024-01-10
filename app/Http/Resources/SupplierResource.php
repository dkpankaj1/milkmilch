<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'userId'    => $this->user_id,
            "name"      => $this->user->name,
            "email"     => $this->user->email,
            'phone'     => $this->user->phone,
            'address'   => $this->user->address,
            'city'      => $this->user->city,
            'state'     => $this->user->state,
            'postalCode' => $this->user->postal_code,
            'country'   => $this->user->country,
            'avatar'    => $this->user->avatar,
            'status'    => $this->user->status
        ];
    }
}
