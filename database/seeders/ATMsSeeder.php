<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ATMsSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('a_t_m_s')->insert([
            [
                'terminal'   => 'PAGRL1234',
                'os'         => '10',
                'type'       => 'GRG',
                'location'   => 'On-branch',
                'design'     => 'Lobby',
                'custodian'  => 1,
                'remark'     => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'terminal'   => 'PATML348',
                'os'         => '7',
                'type'       => 'NCR',
                'location'   => 'On-branch',
                'design'     => 'TTW',
                'custodian'  => 1,
                'remark'     => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
