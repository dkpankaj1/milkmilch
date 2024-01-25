<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MilkPurchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_date',
        'supplier_id',
        'total_amt',
        'other_amt',
        'grand_total',
        'discount',
        'discount_type',
        'order_status',
        'payment_status',
        'paid_amt',
        'note'
    ];

    public function supplier() :BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    public function items() : HasMany
    {
        return $this->hasMany(MilkPurchaseItem::class);
    }
    public function payments() : HasMany
    {
        return $this->hasMany(MilkPurchasePayment::class);
    }
}
