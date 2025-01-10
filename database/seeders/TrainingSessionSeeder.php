<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
    {
        $faker = Faker::create('ar_SA');

        for ($i = 0; $i < 10; $i++) {
            DB::table('training_sessions')->insert([
                'package_id' => rand(1, 3),
                'trainer_id' => rand(1, 3),
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'type' => $faker->randomElement(['group', 'personal', 'free']),
                'difficulty_level' => $faker->randomElement(['beginner', 'intermediate', 'advanced']),
                'start_time' => $faker->dateTimeBetween('now', '+1 month'),
                'end_time' => $faker->dateTimeBetween('+1 month', '+2 months'),
                'current_capacity' => $faker->numberBetween(0, 10),
                'max_capacity' => $faker->numberBetween(10, 30),
                'status' => $faker->randomElement(['active', 'expired', 'scheduled']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
