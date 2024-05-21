<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','assign_to','wallet','old_due'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sell::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function belongsRider()
    {
        return $this->belongsTo(User::class,'assign_to','id');
    }
}
