<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('membership_plans')->insert([
            [
                'name' => 'الخطة الأساسية',
                'price' => 150.00,
                'duration_month' => 6,
                'description' => 'خطة عضوية لمدة 6 أشهر مع مزايا أساسية.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'الخطة المتوسطة',
                'price' => 300.00,
                'duration_month' => 12,
                'description' => 'خطة عضوية لمدة سنة مع مزايا متقدمة.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'الخطة المتقدمة',
                'price' => 500.00,
                'duration_month' => 24,
                'description' => 'خطة عضوية لمدة سنتين مع كافة المزايا المميزة.',
                'status' => 'expired',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
