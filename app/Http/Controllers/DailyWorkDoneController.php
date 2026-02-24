<?php

namespace App\Http\Controllers;

use App\Models\DailyWorkDone;
use App\Models\Department;
use App\Models\Project;
use App\Models\TaskType;
use Illuminate\Http\Request;

class DailyWorkDoneController extends Controller
{
   public function index()
{
    $user = auth()->user();

    if ($user->roles->contains('id', 9)) {
        // Employee
        $employeeId = $user->employee?->id;

        if (!$employeeId) {
            return back()->withErrors(['error' => 'No employee profile linked.']);
        }

        $allWorks = DailyWorkDone::with(['department', 'project', 'employee.user'])
            ->where('employee_id', $employeeId)
            ->latest()
            ->get();
    } else {
        // Admin / Super Admin
        $allWorks = DailyWorkDone::with(['department', 'project', 'employee.user'])
            ->latest()
            ->get();
    }

    // TRELLO BOARD DATA (SAFE)
    $boardWorks = [
        'pending'      => $allWorks->where('status', 'pending'),
        'in-progress'  => $allWorks->where('status', 'in-progress'),
        'completed'    => $allWorks->where('status', 'completed'),
    ];

    // FullCalendar Events
    $calendarEvents = $allWorks->map(function ($work) {
        return [
            'id' => $work->id,
            'title' => $work->task_type . ' - ' . ($work->project->name ?? 'No Project'),
            'start' => $work->date,
            'url' => route('daily-work.show', $work->id),
            'backgroundColor' => $work->status === 'completed' ? '#22c55e' : ($work->status === 'in-progress' ? '#eab308' : '#3b82f6'),
            'borderColor' => $work->status === 'completed' ? '#22c55e' : ($work->status === 'in-progress' ? '#eab308' : '#3b82f6'),
            'extendedProps' => [
                'status' => $work->status,
                'detail' => $work->detail,
                'employee' => $work->employee?->user?->name ?? 'Unknown',
            ]
        ];
    })->toArray();

    return view('daily_work.index', compact('allWorks', 'boardWorks', 'calendarEvents'));
}


    public function create()
    {
        return view('daily_work.create', [
            'departments' => Department::all(),
            'projects'    => Project::all(),
            'taskTypes'   => TaskType::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'project_id' => 'required|exists:projects,id',
            'task_type' => 'required|string',
            'quantity' => 'required|integer|min:1|max:5',
            'status' => 'required|in:pending,in-progress,completed',
            'detail' => 'nullable|string',
            'url' => 'nullable|string',
        ]);

        $employeeId = auth()->user()?->employee?->id;

        if (!$employeeId) {
            return back()->withErrors(['error' => 'No employee profile linked.']);
        }

        DailyWorkDone::create(array_merge($validated, [
            'employee_id' => $employeeId
        ]));

        return redirect()->route('daily-work.index')
            ->with('success', 'Daily work added.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in-progress,completed'
        ]);

        DailyWorkDone::where('id', $id)->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }




  public function show($id)
 {
     $work = DailyWorkDone::findOrFail($id);
     $projects = Project::all();
    $departments = Department::all();
    $taskTypes = TaskType::all();
    $work = DailyWorkDone::with(['employee.user', 'department', 'project'])->findOrFail($id);
    return view('daily_work.show', compact('work', 'departments', 'projects', 'taskTypes'));
 }



}
