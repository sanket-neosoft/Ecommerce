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
            ['role_name' => 'Super Admin'],
            ['role_name' => 'Admin'],
            ['role_name' => 'Inventory Manager'],
            ['role_name' => 'Order Manager'],
            ['role_name' => 'Customer'],
        ];
        Role::insert($roles);
    }
}
