<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Super Admin'],
            ['name' => 'uadmin', 'description' => 'System administrator'],
            ['name' => 'branch', 'description' => 'Branch'],
            ['name' => 'head', 'description' => 'Head'],
            ['name' => 'stocker', 'description' => 'Stocker'],
            ['name' => 'om', 'description' => 'Operation Manager'],
            ['name' => 'sm', 'description' => 'Senoir Manager'],
        ];

        foreach ($roles as $role) {
            DB::table('user_groups')->updateOrInsert(
                ['name' => $role['name']], // unique identifier
                ['description' => $role['description'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
