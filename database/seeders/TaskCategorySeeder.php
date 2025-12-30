<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaskCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('task_categories')->insert([
            ['id' => 1, 'name' => 'Hardware Mainatinance', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Sofware Maintenance', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'User Support on Smart Desk', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Network Incident Follow up', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'ATM Vendor Communication', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'ATM Support', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'ATM and Branch Relocation', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Branch Opening', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Switch Configuration', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'LAN Installation', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'Kasper Anntivirus: Agent, database update and license push', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'Ethiotelecom Communication', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
