<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
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
                'name' => 'RMC Admin',
                'email' => 'admin@rdci.com',
                'password' => bcrypt('admin1234'),
                'role' => 'admin',
            ],
            [
                'name' => 'Fakulti Kejuruteraan',
                'email' => 'fk@rdci.com',
                'password' => bcrypt('fakulti1234'),
                'role' => 'faculty',
                'faculty_code' => '5100',
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
