<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
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
                'employee_id' => 1,
                'isActive' => false,
                'email_verified_at' => '2025-12-10 19:39:42',
                'password' => '$2y$12$hY15g4IXQCvTkUa42iXiQ.k5h2xovUfms2qIrQBZTsM26SBFhAuRG',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
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
