<?php

namespace App\Http\Controllers;
use App\Models\Payroll;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $payrolls = Payroll::with('employee')->get();
        return view('payroll.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $employees = \App\Models\Employee::all();
    return view('payroll.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $net_salary = $request->basic_salary + $request->allowances - $request->deductions;

    Payroll::create([
        'employee_id' => $request->employee_id,
        'basic_salary' => $request->basic_salary,
        'allowances' => $request->allowances,
        'deductions' => $request->deductions,
        'net_salary' => $net_salary,
        'pay_date' => $request->pay_date
    ]);

    return redirect()->route('payroll.index')->with('success', 'Payroll processed successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
