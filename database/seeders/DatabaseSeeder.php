<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;


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

        // $this->call(CustomerSeeder::class);

        $this->call(GrijishCustomerSeeder::class);

        $this->call(AjayCustomerSeeder::class);
        


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
