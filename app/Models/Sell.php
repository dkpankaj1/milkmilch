<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'date',
        'other_amt',
        'discount',
        'discount_type',
        'order_status',
        'payment_status',
        'grand_total',
        'paid_amt',
        'note',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(SellItems::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
