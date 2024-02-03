<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
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
            'sell_date' => $this->date,
            'customer' => $this->customer->user->name,
            'order_status' => $this->order_status,
            'payment_status' => $this->payment_status,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'other_charges' => $this->other_amt,
            'grand_total' => $this->grand_total
        ];
    }
}
