<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembershipPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('membership_packages')->insert([
            [
                'name' => 'Basic Package',
                'price' => 100.00,
                'max_training_sessions' => 10,
                'description' => 'باقة تدريبية مع 10 جلسات تدريبية.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium Package',
                'price' => 200.00,
                'max_training_sessions' => 20,
                'description' => 'باقة تدريبية مع 20 جلسة تدريبية، مزايا إضافية.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Advanced Package',
                'price' => 300.00,
                'max_training_sessions' => 30,
                'description' => 'باقة تدريبية مع 30 جلسة تدريبية ومزايا حصرية.',
                'status' => 'expired',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
