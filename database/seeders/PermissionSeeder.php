<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'subscriptions',
            'manage-subscriptions',
            'create-role',
            'edit-role',
            'delete-role',
            'view-trainer',
            'create-trainer',
            'edit-trainer',
            'generate-reports',
            'subscribe-meal-plans',
            'delete-trainer',
            'view-sessions',
            'create-sessions',
            'update-sessions',
            'delete-sessions',
            'manage-equipment',
            'book-session',
            'track-attendance',
            'view-revenue',
            'view-reports',
            'manage-meal-plans',
            'view-meal-plans',
            'view-statistics',
            'view-schedule',
            'view-activities',
            'manage-activities',
            'view-attendance',
            'view-membership-stats',
            'view-package-distribution',
            'list-activities',
            'view-dashboard',
            'view-members',
            'view-equipment',
            'view-memberships',
            'export-memberships-pdf',
            'export-memberships-excel',
            'export-memberships',
            'delete-membership',
            'edit-membership',
            'view-membership-statistics',
            'create-membership',
            'view-membership',
            'manage-membership-package',
            'manage-membership-plan',
            'view-attendance-reports',
            'view-attendance-logs',
            'store-attendance',
            'view-usage-report',
            'view-booking-history',
            'book-cancel-session',
            'can-rating',
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
