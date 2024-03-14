<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_id',
        'product_id',
        'shelf_life',
        'volume',
        'mrp',
        'quentity',
        'available',
        'best_befour'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function sellItems()
    {
        return $this->belongsTo(SellItems::class);
    }
    public function stockStatusColor()
    {
        if ($this->available > 0) {
            if (Carbon::today()->lte(Carbon::parse($this->best_befour))) {
                return 'success';
            } else {
                return 'danger';
            }
        } else {
            return 'info';
        }
    }
}
