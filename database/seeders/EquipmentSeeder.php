<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('equipment')->insert([
            [
                'name' => 'Treadmill',
                'status' => 'Available',
                'description' => 'كارديو',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dumbbells',
                'status' => 'maintenance',
                'description' => 'كارديو',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rowing Machine',
                'status' => 'Available',
                'description' => 'مقاومة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Exercise Bike',
                'status' => 'Available',
                'description' => 'كارديو',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Weight Bench',
                'status' => 'maintenance',
                'description' => 'مقاوموة',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
