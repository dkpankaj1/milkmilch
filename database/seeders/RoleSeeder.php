<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(["name" => "admin"]);
        Role::create(["name" => "staff"]);
        Role::create(["name" => "supplier"]);
        Role::create(["name" => "rider"]);
        Role::create(["name" => "customer"]);

    }
}
