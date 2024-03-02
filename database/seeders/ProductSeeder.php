<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $products = [
            [
                'code' => "MILKMILCHBM0500",
                'name' => "Buffalo Milk (500 ml)",
                'description' => "Buffalo Milk (500 ml)",
                'mrp' => 45.00,
                'volume' => 500,
                'shelf_life' => 2,
                'product_image' => NULL,
                'categorie_id' => 1,
                'unit_id' => 1,
                'status' => 1
            ],
            [
                'code' => "MILKMILCHBM1000",
                'name' => "Buffalo Milk (1 ltr)",
                'description' => "Buffalo Milk (1 ltr)",
                'mrp' => 65.00,
                'volume' => 1000,
                'shelf_life' => 2,
                'product_image' => NULL,
                'categorie_id' => 1,
                'unit_id' => 1,
                'status' => 1
            ],
            [
                'code' => "MILKMILCHCM0500",
                'name' => "Cow Milk (500 ml)",
                'description' => "Cow Milk (500 ml)",
                'mrp' => 45.00,
                'volume' => 500,
                'shelf_life' => 2,
                'product_image' => NULL,
                'categorie_id' => 2,
                'unit_id' => 1,
                'status' => 1
            ],
            [
                'code' => "MILKMILCHCM1000",
                'name' => "Cow Milk (1 ltr)",
                'description' => "Cow Milk (1 ltr)",
                'mrp' => 65.00,
                'volume' => 1000,
                'shelf_life' => 2,
                'product_image' => NULL,
                'categorie_id' => 2,
                'unit_id' => 1,
                'status' => 1
            ]
        ];

        \App\Models\Product::insert($products);
    }
}
