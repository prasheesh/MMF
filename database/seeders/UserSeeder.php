<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User as model;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'mobile_number' => '9876543211',
            'password' => Hash::make('123456'),
            'user_type' => '1',
            'company_name' => 'VMax e-solutions pvt ltd.',
            'role' => '1',
            'address' => 'jubliee enclave, hitech city, Hyderabad',

        ];
        model::create($data);
    }
}
