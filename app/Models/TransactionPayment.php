<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'date',
        'amount',
        'method',
        'status',
        'use_wallet_amt',
        'user_id',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
