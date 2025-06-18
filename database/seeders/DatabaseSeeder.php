<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First create roles and permissions
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Only create test users if they don't exist
        if (app()->environment('local', 'testing')) {
            $this->createTestUsers();
        }
    }

    protected function createTestUsers(): void
    {
        // Skip if users already exist
        if (User::where('email', 'superadmin@example.com')->exists()) {
            return;
        }

        // Create Super Admin user (only if doesn't exist)
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );
        if (!$superAdmin->hasRole('Super Admin')) {
            $superAdmin->assignRole('Super Admin');
        }

        // Create HR Manager user (only if doesn't exist)
        $hrManager = User::firstOrCreate(
            ['email' => 'hr@example.com'],
            [
                'name' => 'HR Manager',
                'password' => bcrypt('password'),
            ]
        );
        if (!$hrManager->hasRole('HR Manager')) {
            $hrManager->assignRole('HR Manager');
        }

        // Create Department Manager user (only if doesn't exist)
        $deptManager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Department Manager',
                'password' => bcrypt('password'),
            ]
        );
        if (!$deptManager->hasRole('Department Manager')) {
            $deptManager->assignRole('Department Manager');
        }

        // Create regular Employee user (only if doesn't exist)
        $employee = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'name' => 'Regular Employee',
                'password' => bcrypt('password'),
            ]
        );
        if (!$employee->hasRole('Employee')) {
            $employee->assignRole('Employee');
        }

        // Create your original test user (only if doesn't exist)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );
    }
}