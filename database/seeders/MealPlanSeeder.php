<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('meal_plans')->insert([
            [
                'name' => 'الخطة الغذائية 1',
                'description' => 'خطة غذائية تحتوي على 2000 سعر حراري يومياً.',
                'calories_per_day' => 2000,
                'price' => 150.00,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'الخطة الغذائية 2',
                'description' => 'خطة غذائية تحتوي على 2500 سعر حراري يومياً.',
                'calories_per_day' => 2500,
                'price' => 200.00,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'الخطة الغذائية 3',
                'description' => 'خطة غذائية تحتوي على 1800 سعر حراري يومياً.',
                'calories_per_day' => 1800,
                'price' => 130.00,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
