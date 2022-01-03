<?php

namespace Database\Seeders;

use App\Models\Configuration;
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
        $email = 'sanket.kumbhare@neosoftmail.com';
        User::insert([
            'firstname' => 'Admin',
            'lastname' => 'admin',
            'email' => $email,
            'password' => Hash::make('admin123'),
            'role_id'=>  1,
            'active' => true,
        ]);
        Configuration::insert([
            'user_id' => 1,
            'notification_email' => $email,
        ]);
    }
}
