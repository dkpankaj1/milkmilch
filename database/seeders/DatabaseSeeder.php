<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categorie;
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
        $this->call(PaymentModeSeeder::class);
        $this->call(MilkSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(ProductSeeder::class);

        $this->call(CustomerSeeder::class);
        
        // User::factory(25)->create();
        // $users = User::all();


        // foreach($users as $user)
        // {
        //     $user->role_id == 3 && Supplier::create(['user_id' => $user->id]);
        //     $user->role_id == 4 && Rider::create(['user_id' => $user->id]);
        //     $user->role_id == 5 && Customer::create(['user_id' => $user->id]);
        // }
    }
}
