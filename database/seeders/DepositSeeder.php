<?php

namespace Database\Seeders;

use App\Enums\DepositStatus;
use App\Models\Deposit;
use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deposit = Deposit::create([
            'address_from' => 'cn',
            'address_to' => 'vi',
            'distance' => 750,
            'weight' => '1,2,5,10',
            'price_percent' => 60,
            'shipping_fee' => 25,
            'tax_percent' => 12,
            'description' => '',
            'status' => DepositStatus::ACTIVE
        ]);

        $deposit = Deposit::create([
            'address_from' => 'cn',
            'address_to' => 'kr',
            'distance' => 950,
            'weight' => '1,2,5,10',
            'price_percent' => 80,
            'shipping_fee' => 35,
            'tax_percent' => 10,
            'description' => '',
            'status' => DepositStatus::ACTIVE
        ]);

        $deposit = Deposit::create([
            'address_from' => 'kr',
            'address_to' => 'vi',
            'distance' => 800,
            'weight' => '1,2,5,10',
            'price_percent' => 80,
            'shipping_fee' => 30,
            'tax_percent' => 12,
            'description' => '',
            'status' => DepositStatus::ACTIVE
        ]);
    }
}
