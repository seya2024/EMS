<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {


        $hqId = \App\Models\HQ::first()->id;
        $districts = [
            ['name' => 'Jimma', 'director' => 'Ato Shimelese', 'HQ_id' => $hqId],
            ['name' => 'South West', 'director' => 'Ato Selamu', 'HQ_id' => $hqId],
            ['name' => 'Nekemete', 'director' => 'Asefawu', 'HQ_id' => $hqId],
            ['name' => 'Hawasa', 'director' => 'Mesay', 'HQ_id' => $hqId],
        ];


        foreach ($districts as $district) {
            District::updateOrCreate(
                ['name' => $district['name']],
                array_merge($district, ['HQ_id' => $hqId])
            );
        }
    }
}
