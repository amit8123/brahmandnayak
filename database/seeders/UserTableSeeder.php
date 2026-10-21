<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'mobile' => '1234567890',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'active' => true,
        ]);
    }
}
