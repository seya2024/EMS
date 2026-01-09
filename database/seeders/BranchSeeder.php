<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use Carbon\Carbon;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $branches = [
            // existing 1-31 entries
            ['id' => 1, 'code' => '21',   'name' => 'Jimma Branch',            'grade' => 'II', 'tag' => 'JM',   'district_id' => 1],
            ['id' => 2, 'code' => '22',   'name' => 'Agaro Branch',            'grade' => 'I',  'tag' => 'AGR',  'district_id' => 1],
            ['id' => 3, 'code' => '23',   'name' => 'Limmugenet Branch',       'grade' => 'I',  'tag' => 'LMG',  'district_id' => 1],
            ['id' => 4, 'code' => 'YB',   'name' => 'Yebu Branch',             'grade' => 'I',  'tag' => 'YB',   'district_id' => 1],
            ['id' => 5, 'code' => 'BL',   'name' => 'Bilida Outlet',           'grade' => 'I',  'tag' => 'BL',   'district_id' => 1],
            ['id' => 6, 'code' => 'AL',   'name' => 'Al-nur IFB',              'grade' => 'I',  'tag' => 'AL',   'district_id' => 1],
            ['id' => 7, 'code' => 'CH',   'name' => 'Gecha Branch',            'grade' => 'I',  'tag' => 'CH',   'district_id' => 1],
            ['id' => 8, 'code' => 'BD',   'name' => 'Bedele Branch',           'grade' => 'I',  'tag' => 'BD',   'district_id' => 1],
            ['id' => 9, 'code' => 'FR',   'name' => 'Furisa Abawoga',          'grade' => 'I',  'tag' => 'FR',   'district_id' => 1],
            ['id' => 10, 'code' => 'CHR',  'name' => 'Chora Outlet',            'grade' => 'I',  'tag' => 'CHR',  'district_id' => 1],
            ['id' => 11, 'code' => 'YY',   'name' => 'Yayo Branch',             'grade' => 'I',  'tag' => 'YY',   'district_id' => 1],
            ['id' => 12, 'code' => 'MT',   'name' => 'Mettu Branch',            'grade' => 'I',  'tag' => 'MT',   'district_id' => 1],
            ['id' => 13, 'code' => 'GH',   'name' => 'Gechi Branch',            'grade' => 'I',  'tag' => 'GH',   'district_id' => 1],
            ['id' => 14, 'code' => 'MSH',  'name' => 'Masha Branch',            'grade' => 'I',  'tag' => 'MSH',  'district_id' => 1],
            ['id' => 15, 'code' => 'MTI',  'name' => 'Meti Branch',             'grade' => 'I',  'tag' => 'MTI',  'district_id' => 1],
            ['id' => 16, 'code' => 'YR',   'name' => 'Yeri Outlet',             'grade' => 'I',  'tag' => 'YR',   'district_id' => 1],
            ['id' => 17, 'code' => 'SHE',  'name' => 'Shebe Branch',            'grade' => 'I',  'tag' => 'SHE',  'district_id' => 1],
            ['id' => 18, 'code' => 'CHD',  'name' => 'Chida Branch',            'grade' => 'I',  'tag' => 'CHD',  'district_id' => 1],
            ['id' => 19, 'code' => 'DNB',  'name' => 'Deneba Branch',           'grade' => 'I',  'tag' => 'DNB',  'district_id' => 1],
            ['id' => 20, 'code' => 'SJ',   'name' => 'Saja Branch',             'grade' => 'I',  'tag' => 'SJ',   'district_id' => 1],
            ['id' => 21, 'code' => 'SK',   'name' => 'Sokoru Outlet',           'grade' => 'I',  'tag' => 'SK',   'district_id' => 1],
            ['id' => 22, 'code' => 'TLY',  'name' => 'Tollay Branch',           'grade' => 'I',  'tag' => 'TLY',  'district_id' => 1],
            ['id' => 23, 'code' => 'SLA',  'name' => 'SilkAmba Branch',         'grade' => 'I',  'tag' => 'SLA',  'district_id' => 1],
            ['id' => 24, 'code' => 'ALF',  'name' => 'Alif Branch',             'grade' => 'I',  'tag' => 'ALF',  'district_id' => 1],
            ['id' => 25, 'code' => 'ALFS', 'name' => 'Alif Outlet',             'grade' => 'I',  'tag' => 'ALFS', 'district_id' => 1],
            ['id' => 26, 'code' => 'HIR',  'name' => 'Hirmata Branch',          'grade' => 'I',  'tag' => 'HIR',  'district_id' => 1],
            ['id' => 27, 'code' => 'MNR',  'name' => 'Meneharia Branch',        'grade' => 'I',  'tag' => 'MNR',  'district_id' => 1],
            ['id' => 28, 'code' => 'IQR',  'name' => 'IFB - Iqra Branch',       'grade' => 'I',  'tag' => 'IQR',  'district_id' => 1],
            ['id' => 29, 'code' => 'ABJ',  'name' => 'Abajifar Branch',         'grade' => 'I',  'tag' => 'ABJ',  'district_id' => 1],
            ['id' => 30, 'code' => 'ABJS', 'name' => 'Abajifar Outlet',         'grade' => 'I',  'tag' => 'ABJS', 'district_id' => 1],
            ['id' => 31, 'code' => 'FRJ',  'name' => 'Ferenji Arada Branch',    'grade' => 'I',  'tag' => 'FRJ',  'district_id' => 1],

            // new entries starting from 32
            ['id' => 32, 'code' => 'JDO',  'name' => 'Jimma District Office',     'grade' => 'I',  'tag' => 'JDO',  'district_id' => 1],
            ['id' => 33, 'code' => 'WDO',  'name' => 'Wolaita District Office',   'grade' => 'I',  'tag' => 'WDO',  'district_id' => 14],
            ['id' => 34, 'code' => 'NDO',  'name' => 'Nekemete District Office',  'grade' => 'I',  'tag' => 'NDO',  'district_id' => 3],
            ['id' => 35, 'code' => 'ADO',  'name' => 'Adama District Office',     'grade' => 'I',  'tag' => 'ADO',  'district_id' => 5],
            ['id' => 36, 'code' => 'SWDO', 'name' => 'South West District Office', 'grade' => 'I',  'tag' => 'SWDO', 'district_id' => 2],
            ['id' => 37, 'code' => 'HDO',  'name' => 'Hawasa District Office',    'grade' => 'I',  'tag' => 'HDO',  'district_id' => 4],
            ['id' => 38, 'code' => 'DDDO', 'name' => 'Dire Dawa District Office', 'grade' => 'I',  'tag' => 'DDDO', 'district_id' => 6],
            ['id' => 39, 'code' => 'DDO',  'name' => 'Dessie District Office',    'grade' => 'I',  'tag' => 'DDO',  'district_id' => 8],
            ['id' => 40, 'code' => 'MDO',  'name' => 'Mekele District Office',    'grade' => 'I',  'tag' => 'MDO',  'district_id' => 7],
            ['id' => 41, 'code' => 'BDO',  'name' => 'Bahir Dar District Office', 'grade' => 'I',  'tag' => 'BDO',  'district_id' => 9],
            ['id' => 42, 'code' => 'SADO', 'name' => 'South Addis District Office', 'grade' => 'I', 'tag' => 'SADO', 'district_id' => 13],
            ['id' => 43, 'code' => 'NADO', 'name' => 'North Addis District Office', 'grade' => 'I', 'tag' => 'NADO', 'district_id' => 10],
            ['id' => 44, 'code' => 'EADO', 'name' => 'East Addis District Office', 'grade' => 'I', 'tag' => 'EADO', 'district_id' => 11],
            ['id' => 45, 'code' => 'WADO', 'name' => 'West Addis District Office', 'grade' => 'I', 'tag' => 'WADO', 'district_id' => 12],


        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['code' => $branch['code']],
                $branch
            );
        }
    }
}
