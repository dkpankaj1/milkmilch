<?php

namespace Database\Seeders;

use App\Models\PaymentMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMode::create(['mode' => 'cash']);
        PaymentMode::create(['mode' => 'online']);
        PaymentMode::create(['mode' => 'bank transfer']);
        PaymentMode::create(['mode' => 'upi']);
        PaymentMode::create(['mode' => 'google pay']);
        PaymentMode::create(['mode' => 'phone pay']);
        PaymentMode::create(['mode' => 'other']);
    }
}
