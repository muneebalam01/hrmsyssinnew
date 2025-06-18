<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for each module
        $permissions = [
            // Dashboard
            'view dashboard',
            
            // Department
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',
            
            // Employees
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',
            
            // Tasks
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',
            
            // Attendance
            'view attendance',
            'create attendance',
            'edit attendance',
            'approve attendance',
            
            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        $hrManager = Role::firstOrCreate(['name' => 'HR Manager', 'guard_name' => 'web']);
        $hrManager->givePermissionTo([
            'view dashboard',
            'view departments', 'edit departments',
            'view employees', 'create employees', 'edit employees',
            'view tasks', 'create tasks', 'assign tasks',
            'view attendance', 'approve attendance',
            'view users'
        ]);

        $deptManager = Role::firstOrCreate(['name' => 'Department Manager', 'guard_name' => 'web']);
        $deptManager->givePermissionTo([
            'view dashboard',
            'view departments',
            'view employees',
            'view tasks', 'create tasks', 'assign tasks',
            'view attendance', 'approve attendance'
        ]);

        $employee = Role::firstOrCreate(['name' => 'Employee', 'guard_name' => 'web']);
        $employee->givePermissionTo([
            'view dashboard',
            'view tasks',
            'view attendance', 'create attendance'
        ]);
    }
}