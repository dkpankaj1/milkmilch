<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AjayCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
              'customer_name' => 'Dr. Roop Kumar',
              'phone' => 8299698633,
              'address' => 'Block 06  LIC Office   Gorakhpur'
            ),
            array(
              'customer_name' => 'Dhanraj Singh',
              'phone' => 9838502486,
              'address' => 'MIG-25-A  Taramandal Gorakhpur'
            ),
            array(
              'customer_name' => 'Ajay Kumar Pandey',
              'phone' => 8299863293,
              'address' => 'Block number 01  House number 202 - Phase 01  Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Ashok Kumar Yadav',
              'phone' => 9415173643,
              'address' => 'Block number 01  House number 203 - Phase 01 Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Hansnath Pandey',
              'phone' => 9839934612,
              'address' => 'Block 1 Flat-303 vasundhra'
            ),
            array(
              'customer_name' => 'Amit singh',
              'phone' => 8090908080,
              'address' => 'Block 3 Flat- 103 vasundhra'
            ),
            array(
              'customer_name' => 'Ratish Kumar Singh',
              'phone' => 9005079785,
              'address' => 'Block number 15  House number 303 - Phase 01 Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Devansh Yadav',
              'phone' => 9044096616,
              'address' => 'Block number 15  House number 304 - Phase 01 Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'M.M Tripathi',
              'phone' => 9415828403,
              'address' => 'Block number 20  House number 203 Vasundhara'
            ),
            array(
              'customer_name' => 'SK Mishra',
              'phone' => 841054444,
              'address' => 'Block number 10  House number 101 Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Rk Yadav',
              'phone' => 8840771399,
              'address' => 'Block 10 Flat-302 vasundhra'
            ),
            array(
              'customer_name' => 'Arun',
              'phone' => 8795616166,
              'address' => 'Block 10 flait no 202 vasundhra'
            ),
            array(
              'customer_name' => 'Jagdish Pratap Singh',
              'phone' => 1234567891,
              'address' => 'In front of Lake View'
            ),
            array(
              'customer_name' => 'SK SINGH',
              'phone' => 1234567890,
              'address' => 'Block-28 Room-301 Vashundhara'
            ),
            array(
              'customer_name' => 'Sant Kumar Sahi',
              'phone' => 9935737609,
              'address' => 'Block number 30  House number 103 - Phase 02 Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Vijay Pratap Singh',
              'phone' => 9415322699,
              'address' => 'Block number 30  House number 301 - Phase 02 Vasundhara enclave taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Sanjay goswal',
              'phone' => 9215774480,
              'address' => 'Block 35 Flait 102 vasundhra'
            ),
            array(
              'customer_name' => 'Vivek Singh',
              'phone' => 1234567892,
              'address' => 'Block-35 House No-103 Vasundhara'
            ),
            array(
              'customer_name' => 'Raghav Kushwah',
              'phone' => 9305499262,
              'address' => 'Block-3  Flat-106  lack view'
            ),
            array(
              'customer_name' => 'Rajesh Singh',
              'phone' => 9415212853,
              'address' => 'near rav gym taramandal'
            ),
            array(
              'customer_name' => 'Dr. Ravi Sankar',
              'phone' => 9455792037,
              'address' => '"hig 40 "'
            ),
            array(
              'customer_name' => 'Krishan Pal Singh',
              'phone' => 9453728811,
              'address' => 'MIG-27l  Taramandal'
            ),
            array(
              'customer_name' => 'Ankur  Ji',
              'phone' => 7080103200,
              'address' => 'Behind Majestic clinicIndia Gorakhpur'
            ),
            array(
              'customer_name' => 'DN Tiwari',
              'phone' => 1234567894,
              'address' => 'Behind Majestic clinicIndia Gorakhpur'
            ),
            array(
              'customer_name' => 'Arvind Singh',
              'phone' => 7754945360,
              'address' => 'Block -21 Flat No-304'
            ),
            array(
              'customer_name' => 'Ajay Pandey',
              'phone' => 7753983742,
              'address' => 'MIG-55'
            ),
            array(
              'customer_name' => 'Alok Pandey',
              'phone' => 8709608957,
              'address' => 'MIG-55'
            ),
            array(
              'customer_name' => 'Amar Nath Ojha',
              'phone' => 9936474499,
              'address' => 'MIG-65  Siddharth Enclave'
            ),
            array(
              'customer_name' => 'Sameer Singh',
              'phone' => 8318226301,
              'address' => 'Taramnadal Gorakhpur'
            ),
            array(
              'customer_name' => 'Satendra Tripathi',
              'phone' => 9455724221,
              'address' => 'Block-3 House No-108'
            ),
            array(
              'customer_name' => 'Prince Yadav',
              'phone' => 8090580510,
              'address' => 'Block-36 Flat No-302'
            ),
            array(
              'customer_name' => 'Preeti Shukla',
              'phone' => 8318082221,
              'address' => 'Block-1  Flat No.  -204'
            ),
            array(
              'customer_name' => 'Pramod Chaturvedi',
              'phone' => 1234567895,
              'address' => 'MIG-9'
            ),
            array(
              'customer_name' => 'Manish Kumar Singh',
              'phone' => 9450668824,
              'address' => 'Near MIG-271  Taramandal'
            ),
            array(
              'customer_name' => 'Modern Dignostic Center',
              'phone' => 9650185647,
              'address' => 'Opposite Hanuman Temple Betihata taramandal gorakhpur'
            ),
            array(
              'customer_name' => 'Ajeet Kumar Singh',
              'phone' => 9936197581,
              'address' => 'Block -10 Flat -204 Vasundhara'
            ),
            array(
              'customer_name' => 'Ruchi Rai',
              'phone' => 1234567896,
              'address' => 'Block -5 Flat-304  Vashundhara'
            ),
            array(
              'customer_name' => 'Amlesh Pandey',
              'phone' => 9838073330,
              'address' => 'Block-35 Flat No-303 Vashundhara'
            ),
            array(
              'customer_name' => 'Shivam Singh',
              'phone' => 8808040355,
              'address' => 'Block-26 Flat No-203 Vashundhara'
            ),
            array(
              'customer_name' => 'Aayushi',
              'phone' => 8840484985,
              'address' => 'Block-26 Flat No-202 Vashundhara'
            ),
            array(
              'customer_name' => 'Kiran Shahi',
              'phone' => 9369860107,
              'address' => 'Block-28 Flat No-302 Vashundhara'
            ),
            array(
              'customer_name' => 'Ankita Mishra',
              'phone' => 7011074150,
              'address' => 'Block-11 Flat No-201 Vashundhara'
            )
          );

        $rider = User::create([
            'name' => "Ajay yadav",
            'email' => "ajayyadav@gmail.com",
            'phone' => "+91-9794xxx940",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 4,
            'status' => 1
        ]);

        Rider::create(['user_id' => $rider->id]);

        foreach ($data as $item) {

            $user = User::create([
                'name' => $item['customer_name'],
                'email' => $item['phone'] . "@milkmilch.com",
                'password' => Hash::make('milkmilch123'),
                'phone' => $item['phone'],
                'address' => $item['address'],
                'city' => "Gorakhput",
                'state' => "Uttar Pradesh",
                'postal_code' => "273001",
                'role_id' => 5,
                'status' => 1
            ]);
            Customer::create(['user_id' => $user->id, 'assign_to' => $rider->id]);
        }
    }
}
