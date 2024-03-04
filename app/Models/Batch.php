<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_code',
        'date',
        'milk_storage_id',
        'volume'
    ];
    public function milk_storage()
    {
        return $this->belongsTo(MilkStorage::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
