<?php 
namespace App\Http\Controllers;
use App\Models\EmployeeDailyTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTasksController extends Controller
{
    public function index()
    {
        
        $employee = Auth::guard('employee')->user();

        if (!$employee) {
            return view('user_tasks.index', ['users_tasks' => []]);
        }
    
        $users_tasks = EmployeeDailyTask::with('employee')
                        ->where('employee_id', $employee->id)
                        ->latest()
                        ->get();
    
        return view('user_tasks.index', compact('users_tasks'));
}


public function show($id)
    {
        $employee = Auth::guard('employee')->user();

        if (!$employee) {
            return redirect()->route('login')->with('error', 'Please log in as employee.');
        }

        $task = EmployeeDailyTask::with('employee')
                    ->where('id', $id)
                    ->where('employee_id', $employee->id) // Security check
                    ->firstOrFail();

        return view('user_tasks.show', compact('task'));
    }

}