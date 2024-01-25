<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkPurchaseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'milk_purchase_id',
        'milk_id',
        'fat_content',
        'shelf_life',
        'volume',
        'mrp',
        'mop',
        'total_amt'
    ];
    public function milk(){
        return $this->belongsTo(Milk::class);
    }
}
