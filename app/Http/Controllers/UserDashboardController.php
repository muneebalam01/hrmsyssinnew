<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $employeeCount = Employee::count();
        return view('auth.dashboard', compact('employeeCount'));
    }
}
