<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [

    'nik',
    'name',
    'phone',
    'position',
    'department',
    'basic_salary',
    'hire_date',
   ];

   public function payrolls()
   {
      return $this->hasMany(Payroll::class);
   }

}

