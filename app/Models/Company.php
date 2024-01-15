<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "phone",
        "address",
        "city",
        "state",
        "postal_code",
        "country",
        "gst_number",
        "pan_number",
        "upi",
        "upi_barcode",
        "website",
        "logo",
        "fevicon",
        'currencies_id',
    ];
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currencies_id');
    }
}
