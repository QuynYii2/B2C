<?php

namespace Database\Seeders;

use App\Enums\WarehouseStatus;
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
        $role1 = Role::create([
            'name' => \App\Enums\Role::ADMIN,
            'description' => 'Admin',
        ]);

        $role2 = Role::create([
            'name' => \App\Enums\Role::USER,
            'description' => 'User',
        ]);
    }
}
