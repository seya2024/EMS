<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HardwareType;
use App\Models\ComputerModel;
use Carbon\Carbon;

class HardwareAndComputerSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Seed hardware types
        $hardwareTypes = [
            ['id' => 1, 'name' => 'Desktop', 'description' => 'Portable computers'],
            ['id' => 2, 'name' => 'Laptop', 'description' => 'Stationary computers'],
            ['id' => 3, 'name' => 'Server', 'description' => 'Enterprise-grade servers'],
        ];

        foreach ($hardwareTypes as $type) {
            HardwareType::updateOrCreate(
                ['id' => $type['id']],
                [
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        // 2. Seed computer models
        $computerModels = [
            // Desktops
            ['name' => 'Dell OptiPlex 380', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 390', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 7010', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 7020', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3020', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3040', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 5040', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 5050', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3060', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3070', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3080', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3000 Micro', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3000 SFF', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3000 Tower', 'hardware_type_id' => 1],
            ['name' => 'Dell OptiPlex 3000 AIO', 'hardware_type_id' => 1],
            ['name' => 'HP Compaq dc5800', 'hardware_type_id' => 1],
            ['name' => 'HP Compaq dc7900', 'hardware_type_id' => 1],
            ['name' => 'HP Compaq 6000 Pro', 'hardware_type_id' => 1],
            ['name' => 'HP Compaq 6200 Pro', 'hardware_type_id' => 1],
            ['name' => 'HP Compaq 6300 Pro', 'hardware_type_id' => 1],
            ['name' => 'HP ProDesk 400 G1', 'hardware_type_id' => 1],
            ['name' => 'HP ProDesk 400 G2', 'hardware_type_id' => 1],
            ['name' => 'HP ProDesk 400 G3', 'hardware_type_id' => 1],
            ['name' => 'HP ProDesk 400 G5', 'hardware_type_id' => 1],
            ['name' => 'HP ProDesk 600 G1', 'hardware_type_id' => 1],
            ['name' => 'HP ProDesk 600 G3', 'hardware_type_id' => 1],
            ['name' => 'HP EliteDesk 800 G1', 'hardware_type_id' => 1],
            ['name' => 'HP EliteDesk 800 G2', 'hardware_type_id' => 1],
            ['name' => 'HP EliteDesk 800 G3', 'hardware_type_id' => 1],
            ['name' => 'HP EliteDesk 800 G5', 'hardware_type_id' => 1],
            ['name' => 'HP ProOne 400 G3', 'hardware_type_id' => 1],
            ['name' => 'HP ProOne 400 G4', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M58', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M700', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M710', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M720', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M900', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M910', 'hardware_type_id' => 1],
            ['name' => 'Lenovo ThinkCentre M920', 'hardware_type_id' => 1],

            // Laptops
            ['name' => 'Dell Latitude E6410', 'hardware_type_id' => 2],
            ['name' => 'Dell Latitude E6430', 'hardware_type_id' => 2],
            ['name' => 'Dell Latitude 5480', 'hardware_type_id' => 2],
            ['name' => 'Dell Latitude 5490', 'hardware_type_id' => 2],
            ['name' => 'Dell Latitude 5500', 'hardware_type_id' => 2],
            ['name' => 'Dell Latitude 5520', 'hardware_type_id' => 2],
            ['name' => 'HP EliteBook 8460p', 'hardware_type_id' => 2],
            ['name' => 'HP EliteBook 840 G3', 'hardware_type_id' => 2],
            ['name' => 'HP EliteBook 840 G5', 'hardware_type_id' => 2],
            ['name' => 'HP ProBook 450 G6', 'hardware_type_id' => 2],
            ['name' => 'Lenovo ThinkPad T430', 'hardware_type_id' => 2],
            ['name' => 'Lenovo ThinkPad T480', 'hardware_type_id' => 2],
            ['name' => 'Lenovo ThinkPad T490', 'hardware_type_id' => 2],
            ['name' => 'Lenovo ThinkPad X260', 'hardware_type_id' => 2],

            // Servers
            ['name' => 'Dell PowerEdge T30', 'hardware_type_id' => 3],
            ['name' => 'Dell PowerEdge R740', 'hardware_type_id' => 3],
            ['name' => 'HP ProLiant ML350 Gen9', 'hardware_type_id' => 3],
            ['name' => 'HP ProLiant DL380 Gen10', 'hardware_type_id' => 3],
            ['name' => 'Lenovo ThinkSystem SR650', 'hardware_type_id' => 3],
        ];

        foreach ($computerModels as $model) {
            ComputerModel::updateOrCreate(
                ['name' => $model['name'], 'hardware_type_id' => $model['hardware_type_id']],
                [
                    'description' => $model['description'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
