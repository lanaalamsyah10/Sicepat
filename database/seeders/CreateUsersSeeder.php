<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'id_driver' => 'Ops320606',
                'district' => 'Karangampel',
                'no_hp' => '08983731034',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role' => 0,
            ],
            [
                'name' => 'Driver',
                'id_driver' => '320606',
                'district' => 'Krangkeng',
                'no_hp' => '089526396629',
                'email' => 'driver@driver.com',
                'password' => bcrypt('password'),
                'role' => 1,
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
