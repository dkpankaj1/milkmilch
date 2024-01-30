<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkStorage extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'milk_id',
        'ttl_volume',
        'avl_volume',
        'avg_shelf_life',
        'status'
    ];

    public function milk()
    {
        return $this->belongsTo(Milk::class);
    }
}
