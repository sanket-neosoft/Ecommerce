<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'firstname' => 'Admin',
            'lastname' => 'admin',
            'email' => 'sanket.kumbhare@neosoftmail.com',
            'password' => Hash::make('admin123'),
            'role_id'=>  1,
            'active' => true,
        ]);
    }
}
