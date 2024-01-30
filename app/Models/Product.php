<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'mrp',
        'volume',
        'shelf_life',
        'product_image',
        'categorie_id',
        'unit_id',
        'status'
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
