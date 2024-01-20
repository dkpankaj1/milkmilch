<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentStatus::create(['status' => 'pending']);
        PaymentStatus::create(['status' => 'partial']);
        PaymentStatus::create(['status' => 'paid']);

    }
}
