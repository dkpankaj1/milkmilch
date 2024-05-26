<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "unique_id",
        "date",
        "customer_id",
        "amount",
        "discount",
        "discount_type",
        "other_amt",
        "grand_total",
        "paid_amount",
        "status",
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sells()
    {
        return $this->belongsToMany(Sell::class);
    }
    public function payment()
    {
        return $this->hasMany(TransactionPayment::class);
    }
}
