<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Rider;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(CompanySeeder::class);

        User::factory()->create([
            'name' => "admin",
            'email' => "admin@email.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'status' => 1
        ]);

        User::factory(25)->create();

        $users = User::all();

        foreach($users as $user)
        {
            $user->role->name == "customer" && Customer::create(['user_id' => $user->id]);
            $user->role->name == "rider" && Rider::create(['user_id' => $user->id]);
            $user->role->name == "supplier" && Supplier::create(['user_id' => $user->id]);
        }
    }
}
