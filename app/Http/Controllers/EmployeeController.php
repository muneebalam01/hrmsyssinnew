<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
          $departments = Department::all();
    return view('employees.create', compact('departments'));
       // return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'salary' => 'nullable|numeric',
            'hired_at' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            // add any other fields you want to validate
        ]);
       if ($request->hasFile('profile_picture')) {
        // ✅ Ensure the directory exists
        if (!Storage::exists('public/employees')) {
            Storage::makeDirectory('public/employees');
        }

        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('public/employees', $fileName);
        $validated['profile_picture'] = $fileName;
    }

    
        $validated['password'] = Hash::make($validated['password']); // ✅ Hash the password before storing
    
        Employee::create($validated);
    
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
         $employee = Employee::findOrFail($id);
    $departments = Department::all(); // ✅ Fetch departments

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted!');
    }

    
}

