<?php

namespace Database\Seeders;

use App\Models\Quarter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $quarters = [
            [
                'id' => 1,
                'name' => 'Quarter I : 2018',
                'start_date' => '2025-07-08',
                'end_date' => '2025-10-10',
                'description' => 'First quarter of Ethiopian Fiscal Year 2018',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Quarter II : 2018',
                'start_date' => '2025-10-11',
                'end_date' => '2026-01-08',
                'description' => 'Second quarter of Ethiopian Fiscal Year 2018',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Quarter III : 2018',
                'start_date' => '2026-01-09',
                'end_date' => '2026-04-08',
                'description' => 'Third quarter of Ethiopian Fiscal Year 2018',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Quarter IV : 2018',
                'start_date' => '2026-04-09',
                'end_date' => '2026-07-07',
                'description' => 'Fourth quarter of Ethiopian Fiscal Year 2018',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];



        foreach ($quarters as $q) {
            Quarter::updateOrCreate($q);
        }
    }
}
