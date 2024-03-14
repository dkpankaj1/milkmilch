<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function milkStatus()
    {
        if ($this->avl_volume > 0) {
            if (Carbon::today()->lte(Carbon::parse($this->created_at)->addDays($this->avg_shelf_life))) {
                return '<span class="badge shade-green min-70">Fresh</span>';
            } else {
                return '<span class="badge shade-red min-70">Expire</span>';
            }
        } else {
            return '<span class="badge shade-yellow min-70">Empty</span>';
        }
    }
    public function isExpire()
    {
        if (Carbon::today()->lte(Carbon::parse($this->created_at)->addDays($this->avg_shelf_life))) {
            return false;
        } else {
            return true;
        }
    }

}
