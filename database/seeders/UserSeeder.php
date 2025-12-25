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
                'email' => 'seidm2031@gmail.com',
                'phone' => '0985192541',
                'address' => 'Jimma',
                'working_unit' => 'Jimma district',
                'role' => 'Admin',
                'email_verified_at' => '2025-12-10 19:39:42',
                'password' => '$2y$12$OaaZ.UuwQweS9XoOHRCK0OJplnrhaQn619SJ5MEYiksCA0X5GvFmK',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],
            [
                'id' => 3,
                'name' => 'Abebe',
                'fname' => 'Abebe',
                'mname' => 'Mamo',
                'lname' => 'Tufa',
                'email' => 'abebe2031@gmail.com',
                'phone' => '0985192541',
                'address' => 'Jimma',
                'working_unit' => 'Jimma district',
                'role' => 'Admin',
                'email_verified_at' => '2025-12-10 19:39:42',
                'password' => '$2y$12$OaaZ.UuwQweS9XoOHRCK0OJplnrhaQn619SJ5MEYiksCA0X5GvFmK',
                'created_at' => '2025-12-09 19:39:53',
                'updated_at' => '2025-12-23 19:40:00',
            ],
            [
                'id' => 4,
                'name' => 'Abebe',
                'fname' => 'Adem',
                'mname' => 'Mohammed',
                'lname' => 'seid',
                'email' => 'adem2031@gmail.com',
                'phone' => '0985192541',
                'address' => 'Jimma',
                'working_unit' => 'Jimma district',
                'role' => 'Admin',
                'email_verified_at' => '2025-12-10 19:39:42',
                'password' => '$2y$12$OaaZ.UuwQweS9XoOHRCK0OJplnrhaQn619SJ5MEYiksCA0X5GvFmK',
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
