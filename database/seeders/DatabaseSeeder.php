<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(WareHouseSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(DepositSeeder::class);
    }
}
