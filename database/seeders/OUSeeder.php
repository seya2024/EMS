<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OU;

class OUSeeder extends Seeder
{
    public function run(): void
    {
        $ous = [
            [
                'id' => 1,
                'name' => 'District',
                'description' => 'District Office',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],

            [
                'id' => 2,
                'name' => 'Branch',
                'description' => 'Branch',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],

            [
                'id' => 3,
                'name' => 'Head Office',
                'description' => 'Corpoarte',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],

            [
                'id' => 4,
                'name' => 'IT Operations',
                'description' => 'IT Operations',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],
            [
                'id' => 5,
                'name' => 'ATM Vendor',
                'description' => 'ATM Vendor',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],

        ];

        foreach ($ous as $organizationUnit) {
            OU::updateOrCreate(
                ['name' => $organizationUnit['name']],
                $organizationUnit
            );
        }
    }
}
