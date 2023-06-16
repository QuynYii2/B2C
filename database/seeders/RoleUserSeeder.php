<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', \App\Enums\Role::ADMIN)->first();
        $userRole = Role::where('name', \App\Enums\Role::USER)->first();

        $admin = User::where('id', 1)->first();
        $user = User::where('id', 2)->first();

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
