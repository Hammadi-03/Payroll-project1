<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'allowance',
        'deduction',
        'net_salary',
        'month_year',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
