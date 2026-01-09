<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        $adminRole = UserGroup::where('name', 'admin')->first();

        $users = [
            [
                'id' => 1,
                'name' => 'Abebe',
                'fname' => 'Seid',
                'mname' => 'Mohammed',
                'lname' => 'Seid',
                'email' => 'seid.mohammedseid@dashenbanksc.com',
                'phone' => '0985192541',
                'address' => 'Jimma',
                'branch_id' => 1,
                'role' => 'admin',
                //'role' => $adminRole->id, // correct assignment
                'employee_id' => 1,
                'isActive' => true,
                'email_verified_at' => now(),
                'password' => '$2y$12$SzSltzBZd5MLAozNCCOKMurlkVw.acAEC28Z59V/PhWtbJAGBTaoO',
                // 'password'  => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
