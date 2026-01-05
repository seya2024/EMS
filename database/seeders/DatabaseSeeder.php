<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quarter;
use App\Models\OtherAsset;
use App\Models\ComputerModel;
use Illuminate\Database\Seeder;
use App\Models\OrganizationUnit;
use Database\Seeders\QuarterSeeder as SeedersQuarterSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // Create a specific user
        // User::factory()->create([
        //     'name' => 'Seid Mohammed',
        //     'email' => 'seidm2031@gmail.com',
        // ]);

        // Call other seeders, order matter for foreign key constraints
        $this->call([


            UserGroupSeeder::class,
            DistrictSeeder::class,   // districts first
            BranchSeeder::class,     // then branches
            UserSeeder::class,
            HQSeeder::class,     //  2nd order // 3rd order  // 4th order
            OutletSeeder::class,  // 5th order
            HardwareAndComputerSeeder::class,
            // HardwareTypeSeeder::class,
            // ComputerModelSeeder::class,
            ComputerSeeder::class, // 6th order
            DowntimeReasonsSeeder::class,
            ATMsSeeder::class,
            OUSeeder::class,
            TaskCategorySeeder::class,
            TaskSeeder::class,
            OtherAssetSeeder::class,
            PermissionSeeder::class,
            QuarterSeeder::class,



        ]);
    }
}


   // finally users