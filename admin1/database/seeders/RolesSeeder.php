<?php

namespace Database\Seeders;

use App\Models\Role as model;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['role' => 'Super Admin',
             'status' => 1],
            ['role' => 'Admin',
            'status' => 1],
            ['role' => 'Manager',
            'status' => 1]
        ];

        foreach($data as $d)
        {
            model::create($d);
        }
    }
}
