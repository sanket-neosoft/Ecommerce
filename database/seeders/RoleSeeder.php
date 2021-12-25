<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role_name' => 'super admin'],
            ['role_name' => 'admin'],
            ['role_name' => 'inventory manager'],
            ['role_name' => 'order manager'],
            ['role_name' => 'customer'],
        ];
        Role::insert($roles);
    }
}
