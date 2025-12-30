<?php

namespace Database\Seeders;

use App\Models\OrganizationUnit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            UserSeeder::class,   //  1st order
            HQSeeder::class,     //  2nd order
            DistrictSeeder::class, // 3rd order
            BranchSeeder::class,  // 4th order
            OutletSeeder::class,  // 5th order
            ComputerSeeder::class, // 6th order
            DowntimeReasonsSeeder::class,
            ATMsSeeder::class,
            OUSeeder::class,
            TaskCategorySeeder::class,
            TaskSeeder::class,
        ]);
    }
}
