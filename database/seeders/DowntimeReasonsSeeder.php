<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DowntimeReasonsSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('downtime_reasons')->insert([
            ['name' => 'No Power',        'responsible' => 'Electric-Utility',    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'No Network',      'responsible' => 'Ethiotelecom',       'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dispenser',       'responsible' => 'Vendor',             'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Card Reader',     'responsible' => 'Vendor',             'created_at' => $now, 'updated_at' => $now],
            ['name' => 'EPP',             'responsible' => 'Vendor',             'created_at' => $now, 'updated_at' => $now],
            ['name' => 'No cash',         'responsible' => 'The-branch',         'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Note Jam',        'responsible' => 'The-branch',         'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cassette Error',  'responsible' => 'Vendor',             'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Relocation',      'responsible' => 'Digital-channel',    'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
