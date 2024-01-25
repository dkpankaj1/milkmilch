<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilkPurchasePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'milk_purchase_id',
        'payment_mode_id',
        'amt'
    ];
    public function milkPurchase() : BelongsTo
    {
        return $this->belongsTo(MilkPurchase::class);
    }
}
