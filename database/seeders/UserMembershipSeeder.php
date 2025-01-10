<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('user_memberships')->insert([
            [
                'user_id' => 1,
                'plan_id' => 1,
                'package_id' => 1,
                'start_date' => '2025-01-01',
                'end_date' => '2025-06-01',
                'remaining_sessions' => 10,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'plan_id' => 2,
                'package_id' => 2,
                'start_date' => '2024-07-01',
                'end_date' => '2025-07-01',
                'remaining_sessions' => 15,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'plan_id' => 3,
                'package_id' => null,
                'start_date' => '2023-05-01',
                'end_date' => '2024-05-01',
                'remaining_sessions' => 0,
                'status' => 'expired',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'plan_id' => 1,
                'package_id' => 3,
                'start_date' => '2025-02-01',
                'end_date' => '2025-08-01',
                'remaining_sessions' => 5,
                'status' => 'cancelled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
