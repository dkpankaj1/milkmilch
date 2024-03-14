<?php

namespace Database\Seeders;

use App\Models\Milk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MilkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Milk::create([
            'name' => 'Cow Milk',
            'fat_content' => 10.5   ,
            'shelf_life' => 2,
            'volume' => 1.00,
            'mrp' => 45.00,
            'mop' => 40.00,
            'status' => 1,
            'description' => 'description',
        ]);

        Milk::create([
            'name' => 'Buffalo Milk',
            'fat_content' => 18.5   ,
            'shelf_life' => 2,
            'volume' => 1.00,
            'mrp' => 35.00,
            'mop' => 30.00,
            'status' => 1,
            'description' => 'description',
        ]);

    }
}
