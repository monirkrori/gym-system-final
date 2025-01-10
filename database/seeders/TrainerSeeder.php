<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
    {
        Trainer::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'specialization' => 'اللياقة البدنية',
            'experience_years' => 5,
            'rating_avg' => 4.5,
            'status' => 'available',
        ]);

        Trainer::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'specialization' => 'التغذية',
            'experience_years' => 3,
            'rating_avg' => 4.0,
            'status' => 'unavailable',
        ]);

        Trainer::create([
            'user_id' => User::inRandomOrder()->first()->id,
            'specialization' => 'اليوغا',
            'experience_years' => 7,
            'rating_avg' => 4.8,
            'status' => 'available',
        ]);
    }

}
