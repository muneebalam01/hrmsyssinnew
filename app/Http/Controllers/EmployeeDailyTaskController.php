<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDailyTask;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeDailyTaskController extends Controller
{
    // Display all employee daily tasks
    public function index()
    {
        $tasks = EmployeeDailyTask::with('employee')->latest()->get();
        return view('employee_daily_tasks.index', compact('tasks'));
    }

    // Show the form to create a new task
    public function create()
    {
        $employees = Employee::all();
        return view('employee_daily_tasks.create', compact('employees'));
    }

    // Store a newly created task in the database
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'task_subject' => 'required|string|max:255',
        'task_date' => 'required|date',
        'task_description' => 'required|string',
        'priority' => 'required|in:urgent,normal',
        'status' => 'required|in:pending,in_progress,completed',
        ]);
         $validated['assigned_by'] = auth()->id();
         //dd($validated);
        EmployeeDailyTask::create($validated);
        
       // EmployeeDailyTask::create($request->all());
        return redirect()->route('employee-daily-tasks.index')->with('success', 'Task created successfully.');
    }

    // Show the form to edit an existing task
    public function edit(EmployeeDailyTask $employee_daily_task)
    {
        $employees = Employee::all();
        return view('employee_daily_tasks.edit', [
            'task' => $employee_daily_task,
            'employees' => $employees,
        ]);
    }
    
    public function update(Request $request, EmployeeDailyTask $employee_daily_task)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'task_date' => 'required|date',
            'task_description' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed',
        ]);
    
        $employee_daily_task->update($validated);
    
        return redirect()->route('employee-daily-tasks.index')->with('success', 'Task updated successfully!');
    }


    public function show(EmployeeDailyTask $employee_daily_task)
{
    $employee_daily_task->load('employee'); 
    return view('employee_daily_tasks.show', compact('employee_daily_task'));
}

    
    
}
