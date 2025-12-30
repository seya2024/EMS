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
            ['id' => 1, 'code' => '21', 'name' => 'Jimma Branch', 'grade' => 'II', 'tag' => 'JM', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'code' => '22', 'name' => 'Agaro Branch', 'grade' => 'I', 'tag' => 'AGR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'code' => '23', 'name' => 'Limmugenet Branch', 'grade' => 'I', 'tag' => 'LMG', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'code' => 'YB', 'name' => 'Yebu Branch', 'grade' => 'I', 'tag' => 'YB', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'code' => 'BL', 'name' => 'Bilida outlet', 'grade' => 'I', 'tag' => 'BL', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'code' => 'AL', 'name' => 'Al-nur IFB', 'grade' => 'I', 'tag' => 'AL', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'code' => 'CH', 'name' => 'Gecha Branch', 'grade' => 'I', 'tag' => 'CH', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'code' => 'BD', 'name' => 'Bedele Branch', 'grade' => 'I', 'tag' => 'BD', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'code' => 'FR', 'name' => 'Furisa Abawoga', 'grade' => 'I', 'tag' => 'FR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'code' => 'CHR', 'name' => 'Chora Outlet', 'grade' => 'I', 'tag' => 'CHR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'code' => 'YY', 'name' => 'Yayo Branch', 'grade' => 'I', 'tag' => 'YY', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'code' => 'MT', 'name' => 'Mettu Branch', 'grade' => 'I', 'tag' => 'MT', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'code' => 'GH', 'name' => 'Gecha Branch', 'grade' => 'I', 'tag' => 'GH', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'code' => 'MSH', 'name' => 'Masha Branch', 'grade' => 'I', 'tag' => 'MSH', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'code' => 'MTI', 'name' => 'Meti Branch', 'grade' => 'I', 'tag' => 'MTI', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'code' => 'YR', 'name' => 'Yeri outlet', 'grade' => 'I', 'tag' => 'YR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 17, 'code' => 'SHE', 'name' => 'Shebe Branch', 'grade' => 'I', 'tag' => 'SHE', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 18, 'code' => 'CHD', 'name' => 'Chida Branch', 'grade' => 'I', 'tag' => 'CHD', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 19, 'code' => 'DNB', 'name' => 'Deneba Branch', 'grade' => 'I', 'tag' => 'DNB', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20, 'code' => 'SJ', 'name' => 'Saja Branch', 'grade' => 'I', 'tag' => 'SJ', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 21, 'code' => 'SK', 'name' => 'Sokoru Outlet', 'grade' => 'I', 'tag' => 'SK', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 22, 'code' => 'TLY', 'name' => 'Tollay Branch', 'grade' => 'I', 'tag' => 'TLY', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 23, 'code' => 'SLA', 'name' => 'SilkAmba Branch', 'grade' => 'I', 'tag' => 'SLA', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 24, 'code' => 'ALF', 'name' => 'Alif Branch', 'grade' => 'I', 'tag' => 'ALF', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 25, 'code' => 'ALFS', 'name' => 'Alif Outlet', 'grade' => 'I', 'tag' => 'ALFS', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 26, 'code' => 'HIR', 'name' => 'Hirmata Branch', 'grade' => 'I', 'tag' => 'HIR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 27, 'code' => 'MNR', 'name' => 'Meneharia Branch', 'grade' => 'I', 'tag' => 'MNR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 28, 'code' => 'IQR', 'name' => 'IFB- Iqra Branch', 'grade' => 'I', 'tag' => 'IQR', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 29, 'code' => 'ABJ', 'name' => 'Abajifar Branch', 'grade' => 'I', 'tag' => 'ABJ', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 30, 'code' => 'ABJS', 'name' => 'Abajifar Outlet', 'grade' => 'I', 'tag' => 'ABJS', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 31, 'code' => 'FRJ', 'name' => 'Ferenji Arada Branch', 'grade' => 'I', 'tag' => 'FRJ', 'district_id' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['code' => $branch['code']],
                $branch
            );
        }
    }
}
