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
           'mobile_number' => '8977936619',
            'password' => Hash::make('123456'),

        ];
        model::create($data);
    }
}
