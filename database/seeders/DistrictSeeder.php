<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $districts = [
            ['id' => 1, 'name' => 'Jimma', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'South West', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Nekemete', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Hawasa', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Adama', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Dire Dawa', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Mekele', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Dessie', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Bahir Dar', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'North Addis', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'East Addis', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'West Addis', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'name' => 'South Addis', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'name' => 'Wolaita', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'name' => 'Head Office', 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['id' => $district['id']],
                $district
            );
        }
    }
}
