<?php

return [
    [
        'label' => 'Dashboard',
        'route' => 'auth.dashboard',
        'roles' => [1, 2],
    ],
    [
        'label' => 'Department',
        'route' => 'departments.index',
        'roles' => [1, 2],
    ],
    [
        'label' => 'Employees',
        'route' => 'employees.index',
        'roles' => [1, 2],
    ],
    [
        'label' => 'Tasks',
        'route' => 'employee-daily-tasks.index',
        'roles' => [1, 2],
    ],
    [
        'label' => 'My Tasks',
        'route' => 'user-tasks.index',
        'roles' => [9],
    ],
    [
        'label' => 'Attendance & Time Tracking',
        'route' => 'attendance.index',
        'roles' => [1, 2,9],
    ],
    [
        'label' => 'Users',
        'route' => '#',
        'roles' => [1, 2],
    ],
];
