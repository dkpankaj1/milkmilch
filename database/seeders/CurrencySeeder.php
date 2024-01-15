<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => "rupees",
            'code' => 'INR',
            'symbol' => '₹',
            'description' => 'Indian Rupee',
        ]);

        Currency::create([
            'name' => "dollar",
            'code' => 'USD',
            'symbol' => '$',
            'description' => 'U.S. Dollar',
        ]);
    }
}
