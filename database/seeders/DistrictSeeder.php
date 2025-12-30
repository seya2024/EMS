<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {


        District::updateOrCreate(
            ['id' => 1, 'name' => 'Jimma'],
            ['i' => 2, 'name' => 'South West'],
            ['id' => 3, 'name' => 'Nekemete'],
            ['id' => 4, 'name' => 'Hawasa'],
        );
    }
}
