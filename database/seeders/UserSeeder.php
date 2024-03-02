<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Rider;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "admin",
            'email' => "admin@email.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'status' => 1
        ]);
        User::create([
            'name' => "staff",
            'email' => "staff@email.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 2,
            'status' => 1
        ]);
        $supplier = User::create([
            'name' => "supplier",
            'email' => "supplier@email.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 3,
            'status' => 1
        ]);
        $rider = User::create([
            'name' => "rider",
            'email' => "rider@email.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 4,
            'status' => 1
        ]);

        $arman = User::create([
            'name' => "arman khan",
            'email' => "armankhan@gmail.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 4,
            'status' => 1
        ]);

        $ajay = User::create([
            'name' => "ajay yadav",
            'email' => "ajayyadav@gmail.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 4,
            'status' => 1
        ]);
        $customer = User::create([
            'name' => "customer",
            'email' => "customer@email.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 5,
            'status' => 1
        ]);

        Supplier::create(['user_id' => $supplier->id]);
        Rider::create(['user_id' => $rider->id]);
        Rider::create(['user_id' => $arman->id]);
        Rider::create(['user_id' => $ajay->id]);
        Customer::create(['user_id' => $customer->id]);
        
    }
}
