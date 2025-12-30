<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tasks')->insert([
            ['id' => 1, 'task_category_id' => 2, 'name' => 'Operating System Re-installation', 'description' => '192.168.163.113', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'task_category_id' => 2, 'name' => 'From Window 10 to Window 11 Upgrade', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'task_category_id' => 1, 'name' => 'Hard Drive Replacement', 'description' => '192.168.163.110', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'task_category_id' => 1, 'name' => 'CMOS Battry Replacement', 'description' => '192.168.163.87', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'task_category_id' => 1, 'name' => 'Power supply Replacement', 'description' => '192.168.163.45', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'task_category_id' => 12, 'name' => 'Office letter preparation for Ethiotelecomn', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'task_category_id' => 11, 'name' => 'Kasper database update', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
