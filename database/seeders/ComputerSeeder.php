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
            [
                // 'id' => 1,
                // 'hardwareType' => 'Laptop',
                // 'pcModel' => 'HP Brobook 450 G9',
                // 'tagNo' => 'DB/JDO/4.1/1256',
                // 'serialNo' => '588HGHF',
                // 'harddiskSize' => '1TB',
                // 'ramSize' => '500GB',
                // 'speed' => '2.3GHZ',
                // 'unit' => 'pcs',
                // 'os' => 'Windows 11',
                // 'isActivated' => 1,
                // 'IpAddress' => '192.168.163.113',
                // 'hostName' => 'W-BRN-JDO-4666',
                // 'status' => 'Functional',
                // 'branch_id' => 1,
                // 'created_at' => '2025-12-25 05:25:44',
                // 'updated_at' => '2025-12-25 05:25:44',
            ],


        ];

        // foreach ($computers as $computer) {
        //     Computer::updateOrCreate(
        //         ['tagNo' => $computer['tagNo']],
        //         $computer
        //     );
        // }
    }
}
