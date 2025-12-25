<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HQ;

class HQSeeder extends Seeder
{
    public function run(): void
    {
        HQ::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Head Office',
                'slogan' => 'One step a head',
            ]
        );
    }
}
