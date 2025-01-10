<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'moner kfori',
            'email' => 'monirkfori7@gmail.com',
            'password' => Hash::make('monir12345'),
            'email_verified_at' => now(),
            'phone_number' => '1234567890',
            'profile_photo' => 'profile_photos/super_admin_photo.jpg',
        ]);
        $superAdmin->assignRole('Super admin');

        $admin = User::create([
            'name' => 'hala hasan',
            'email' => 'halahasan@gmail.com',
            'password' => Hash::make('hala12345'),
            'phone_number' => '0987654321',
            'profile_photo' => 'profile_photos/admin_photo.jpg',
        ]);
        $admin->assignRole('admin');

        $trainer = User::create([
            'name' => 'fatima saleh',
            'email' => 'fatimasaleh@gmail.com',
            'password' => Hash::make('fatima12345'),
            'phone_number' => '1231231234',
            'profile_photo' => 'profile_photos/trainer_photo.jpg',
        ]);
        $trainer->assignRole('trainer');

        $member = User::create([
            'name' => 'hadeel hanna',
            'email' => 'hadeelhanna@gmail.com',
            'password' => Hash::make('hadeel12345'),
            'phone_number' => '5675675678',
            'profile_photo' => 'profile_photos/member_photo.jpg',
        ]);
        $member->assignRole('member');
    }
}
