<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OtherAssetSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('asset_classes')->insert([
            [
                'id' => 1,
                'name' => 'Furniture & Office Materials',
                'description' => 'Office materials',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Digital Computer',
                'description' => 'Digital Computer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
