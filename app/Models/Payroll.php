<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'allowances',
        'deductions',
        'net_salary',
        'pay_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}