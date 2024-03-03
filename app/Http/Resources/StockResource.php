<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "batch_id" => $this->batch_id,
            "product_id" => $this->product_id,
            "product" => $this->product->name,
            "product_code" => $this->product->code,
            "shelf_life" => $this->shelf_life,
            "volume" => $this->volume,
            "mrp" => $this->mrp,
            "quentity" => $this->quentity,
            "available" => $this->available,
            "best_befour" => $this->best_befour,
        ];
    }
}
