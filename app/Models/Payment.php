<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_id",
        "date",
        "amount",
        "discount",
        "discount_type",
        "other_amt",
        "grand_total",
        "paid_amount",
        "payment_status",
        "user_id"
    
    ];

    public function sales(){
        return $this->hasMany(Sell::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
