<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'id' => 1,
                'code' => '21',
                'name' => 'Jimma',
                'grade' => 'II',
                'tag' => 'JM',
                'district_id' => 1,
                'created_at' => '2025-12-03 10:42:47',
                'updated_at' => '2025-12-03 10:42:47',
            ],
            [
                'id' => 2,
                'code' => '22',
                'name' => 'Agaro',
                'grade' => 'I',
                'tag' => 'AGR',
                'district_id' => 1,
                'created_at' => '2025-12-03 10:42:47',
                'updated_at' => '2025-12-03 10:42:47',
            ],
            [
                'id' => 3,
                'code' => '23',
                'name' => 'Limmugenet',
                'grade' => 'I',
                'tag' => 'LMG',
                'district_id' => 1,
                'created_at' => '2025-12-23 16:13:46',
                'updated_at' => '2025-12-23 16:13:46',
            ],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['code' => $branch['code']],
                $branch
            );
        }
    }
}
