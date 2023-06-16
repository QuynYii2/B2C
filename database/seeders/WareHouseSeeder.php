<?php

namespace Database\Seeders;

use App\Enums\WarehouseStatus;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WareHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse = Warehouse::create([
            'name' => 'WareHouse HaDong VietNam',
            'email' => 'vietnam@nn21.com',
            'phone' => '+8493-627-7000',
            'address' => 'V7-B07, Land lot TTDV 01, Terra An Hung New Urban Area, La Khe Ward, Ha Dong District, Hanoi City, Viet Nam',
            'status' => WarehouseStatus::ACTIVE
        ]);

        $warehouse1 = Warehouse::create([
            'name' => 'WareHouse Incheon Korea',
            'email' => 'korea@nn21.com',
            'phone' => '+8232-772-8481',
            'address' => 'IL Building 3rd Floor, 144-72 Injung-Ro, Jung-Gu, Incheon, South Korea',
            'status' => WarehouseStatus::ACTIVE
        ]);

        $warehouse2 = Warehouse::create([
            'name' => 'WareHouse PyeongTaek Korea',
            'email' => 'korea@nn21.com',
            'phone' => '+8231-681-8482',
            'address' => '9 Posengeub Pyeongtaekhang-Ro 3rd Floor, Pyengtaek City, gyeonggi-Do, South Korea',
            'status' => WarehouseStatus::ACTIVE
        ]);

        $warehouse3 = Warehouse::create([
            'name' => 'WareHouse Guangzhou Office',
            'email' => 'ilgz@nn21.com',
            'phone' => '+86138-2621-4498',
            'address' => '101-103, Building E1, Hongsen International Logistics Area, Jiahe Street, Baiyun District, Guangzhou, Guangdong City',
            'status' => WarehouseStatus::ACTIVE
        ]);

        $warehouse4 = Warehouse::create([
            'name' => 'WareHouse Shanghai Office',
            'email' => 'ilgz@nn21.com',
            'phone' => '+86136-5650-8768',
            'address' => '8 Sixing Road, Liuxiang Road, Jiading District, Shanghai',
            'status' => WarehouseStatus::ACTIVE
        ]);

        $warehouse5 = Warehouse::create([
            'name' => 'WareHouse Qingdao China',
            'email' => 'ilgz@nn21.com',
            'phone' => '+86150-2008-8370',
            'address' => 'Room 208, Building 1, Shanhang Logistics Park, Liangjiang Road, Chengyang District, Qingdao, Shandong, China',
            'status' => WarehouseStatus::ACTIVE
        ]);
    }
}
