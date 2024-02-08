<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Categorie::create(['name' => 'Buffalo Milk','slug' => 'buffalo-milk','description' => 'Buffalo Milk','status' => 1]);
        \App\Models\Categorie::create(['name' => 'Cow Milk','slug' => 'cow-milk','description' => 'Cow Milk','status' => 1]);
    }
}
