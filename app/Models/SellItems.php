<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'sell_id',
        'stock_id',
        'quentity',
        'mrp',
        'total_amt',
    ];
    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
