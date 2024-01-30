<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'name' => 'PC',
            'description' => 'Piece',
            'status' => 1
        ]);

        Unit::create([
            'name' => 'PKT',
            'description' => 'Packet',
            'status' => 1
        ]);
    }
}
