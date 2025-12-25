<?php

namespace Database\Seeders;

use App\Models\Computer;
use App\Models\District;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
    public function run(): void
    {
        $computers = [
            // [
            //     'id' => 1,
            //     'hardwareType' => 'Desktop',
            //     'pcModel' => 'HP ProBook 450 G9',
            //     'tagNo' => 'DB/JDO/4.1/34345',
            //     'serialNo' => '858dfkdj',
            //     'harddiskSize' => '1TB',
            //     'ramSize' => '8GB',
            //     'speed' => 'Intel Core(TM)i5-8500CPU@3.00GHZ',
            //     'os' => 'Windows 11',
            //     'isActivated' => 1,
            //     'IpAddress' => '192.168.163.113',
            //     'hostName' => 'W-BRN-JDO-1165',
            //     'owner_id' => 1,
            //     'owner_type' => District::class,
            //     'status' => 'Active',
            //     'created_at' => '2025-12-23 21:22:00',
            //     'updated_at' => '2025-12-24 02:23:05',
            // ],
            // [
            //     'id' => 2,
            //     'hardwareType' => 'Desktop',
            //     'pcModel' => 'Dell 3080',
            //     'tagNo' => 'DB/JDO/4.1/34388',
            //     'serialNo' => '858GDJD',
            //     'harddiskSize' => '500gb',
            //     'ramSize' => '4GB',
            //     'speed' => 'Intel Core(TM)i5-8500CPU@3.00GHZ',
            //     'os' => 'Windows 11',
            //     'isActivated' => 1,
            //     'IpAddress' => '192.168.163.119',
            //     'hostName' => 'W-BRN-JDO-1160',
            //     'owner_id' => 1,
            //     'owner_type' => District::class,
            //     'status' => 'Active',
            //     'created_at' => '2025-12-23 21:22:00',
            //     'updated_at' => '2025-12-23 20:06:58',
            // ],
        ];

        foreach ($computers as $computer) {
            Computer::updateOrCreate(
                ['tagNo' => $computer['tagNo']],
                $computer
            );
        }
    }
}
