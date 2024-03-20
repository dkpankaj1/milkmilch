<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class GrijishCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = array(
            array(
              'customer_name' => 'Som Shankar Dubey',
              'phone' => 9885409389,
              'address' => 'HIG-510, Near Sarmount  Senior',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Vaibhav Pandey',
              'phone' => 9151708975,
              'address' => 'MIG-75',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Ranvijay Vishwkarma',
              'phone' => 9415212256,
              'address' => 'HIG - C-320   Near Lack View',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Aditya Thakurai',
              'phone' => 7526055792,
              'address' => 'LIG-34,35,Siddharth Puram Vaster gorakhpur',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Dharampal Yadavanshi',
              'phone' => 'Not Given',
              'address' => 'Taramnadal',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Atul Srivastava',
              'phone' => 8543822341,
              'address' => 'Msar Childiy Ghar, Gorakhpur',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Ashutosh Srivastva',
              'phone' => 7880401601,
              'address' => 'Msar Childiy Ghar, Gorakhpur',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Saumya Tripathi',
              'phone' => 8802013132,
              'address' => 'Opposite GDA Office',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Shailendra Singh1st floor',
              'phone' => 7905279403,
              'address' => 'Opposite GDA Office',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Shailesh Singh',
              'phone' => 8510092255,
              'address' => 'Opposite GDA Office',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Rajvansh',
              'phone' => 7905798349,
              'address' => 'HIB A-337, Near Bharat Marbeles',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Santosh Singh',
              'phone' => 9838957844,
              'address' => 'HIG-36 Siddharth Near Bharat Marbal Taramandal',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Umang',
              'phone' => 730913210,
              'address' => 'House no 34, Taramandal Gorakhpur',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Guddu Gupta',
              'phone' => 8486922569,
              'address' => 'Sector - 23, Sahjanwa, Gorakhpur',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Jaidev Singh',
              'phone' => 8009901133,
              'address' => 'Opposite GDA Office',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Neha Tripathi',
              'phone' => 7007868419,
              'address' => 'Opposite GDA Office',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'CA Jugunu Dubey',
              'phone' => 9936258794,
              'address' => 'Near Taramandal',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Bhanu Pratap Singh',
              'phone' => 9415855634,
              'address' => 'Near Nauka Vihar',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Kamlesh Chandra Tripathi',
              'phone' => 8573900133,
              'address' => 'Childiy Ghar, Gorakhpur',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Supriya Nitish Rai',
              'phone' => 9621273434,
              'address' => 'Sattashi House ,Opp. GDA Ofice',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Vaibhav Rai',
              'phone' => 8318620608,
              'address' => 'Yashodhara R-201',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Garima Verma',
              'phone' => 9696122211,
              'address' => 'Lake View Coloney',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Anup Singh',
              'phone' => 7084295555,
              'address' => 'Lake View Coloney',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Himanshu Triphati',
              'phone' => 8141499105,
              'address' => 'Lake View Coloney',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Shailendra Singh',
              'phone' => 9415643642,
              'address' => 'Yashodhara R-9',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Himanshu Kumar',
              'phone' => 8187982675,
              'address' => 'Near Amarawati Apartment',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Vikash Jaiswal',
              'phone' => 8737915258,
              'address' => '" Near Gemini Gorakhpur"',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Krishan Mohan',
              'phone' => 9838000015,
              'address' => 'Near Surmount Schoool Gol Park',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Ashutosh Chandra',
              'phone' => 9935515501,
              'address' => 'Near Surmount Schoool Gol Park',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Amita Tripathi',
              'phone' => 9519064065,
              'address' => 'Near GDA',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Dr. Dwarikanath',
              'phone' => 9415856551,
              'address' => 'Taramnadal',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Poonam Rai',
              'phone' => 9450442159,
              'address' => 'HIG-C-11',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Sujeet Singh',
              'phone' => 7985631968,
              'address' => 'Opposite HIG-107',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Sahwat Pandey',
              'phone' => 9450970796,
              'address' => 'Near Amarawati Apartment',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Sagar',
              'phone' => 7607770449,
              'address' => 'HIG-107',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Rajesh Kumar Rao',
              'phone' => 7007472100,
              'address' => 'HIG-C-11',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Manoj',
              'phone' => 7007953558,
              'address' => 'Near Amarawati Apartment',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Rekha Singh',
              'phone' => 9044443964,
              'address' => 'Vaishali Colony',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Vicky (Vishal)',
              'phone' => 7985037884,
              'address' => 'Inranagar Near Shakuntala Marriage Hall',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            ),
            array(
              'customer_name' => 'Vishal Chidiyghar',
              'phone' => 8004213004,
              'address' => 'Lohiya Colony',
              'postcode' => 273001,
              'status' => 1,
              'state' => 'Uttar Pradesh',
              'city' => 'Gorakhpur'
            )
          );
        
        $rider = User::create([
            'name' => "Girijesh",
            'email' => "girijesh@email.com",
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
                'email'=> $item['phone']."@milkmilch.com",
                'password'=> Hash::make('milkmilch123'),
                'phone' => $item['phone'],
                'address' => $item['address'],
                'city' => $item['city'],
                'state' => $item['state'],
                'postal_code' => $item['postcode'],
                'role_id' => 5,
                'status' =>1
            ]);
            Customer::create(['user_id' => $user->id, 'assign_to'=>$rider->id ]);
        }
    }
}
