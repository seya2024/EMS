<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        $outlets = [
            [
                'id' => 2,
                'name' => 'Bilida Branch',
                'branch_id' => 1,
                'created_at' => '2025-12-23 17:30:38',
                'updated_at' => '2025-12-23 17:30:38',
            ],
        ];

        foreach ($outlets as $outlet) {
            Outlet::updateOrCreate(
                ['name' => $outlet['name'], 'branch_id' => $outlet['branch_id']],
                $outlet
            );
        }
    }
}
