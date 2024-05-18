<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "name" => $this->user->name,
            'phone' => $this->user->phone,
            'address' => $this->user->address,
            'city' => $this->user->city,
            'state' => $this->user->state,
            'postalCode' => $this->user->postal_code,
            'country' => $this->user->country,
        ];
    }
}
