<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Role;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        // Create modules
        $tasks = Module::create(['label' => 'Tasks', 'route' => 'employee-daily-tasks.index']);
        $employees = Module::create(['label' => 'Employees', 'route' => 'employees.index']);
        $departments = Module::create(['label' => 'Departments', 'route' => 'departments.index']);

        // Attach to roles
        $adminRole = Role::find(1); // Super admin
        $adminRole?->modules()->sync([$tasks->id, $employees->id, $departments->id]);

        $employeeRole = Role::find(9); // Employee
        $employeeRole?->modules()->sync([$tasks->id]);
    }
}
