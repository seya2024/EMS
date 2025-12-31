<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            ['id' => 1, 'name' => 'Jimma'],
            ['id' => 2, 'name' => 'South West'],
            ['id' => 3, 'name' => 'Nekemete'],
            ['id' => 4, 'name' => 'Hawasa'],
            ['id' => 5, 'name' => 'Adama'],
            ['id' => 6, 'name' => 'Dire Dawa'],
            ['id' => 7, 'name' => 'Mekele'],
            ['id' => 8, 'name' => 'Dessie'],
            ['id' => 9, 'name' => 'Bahir Dar'],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['id' => $district['id']],
                $district
            );
        }
    }
}
