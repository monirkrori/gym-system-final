<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $faker = Faker::create();

    for ($i = 0; $i < 5; $i++) {
        User::create([
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone_number' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['male', 'female']),
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
}
