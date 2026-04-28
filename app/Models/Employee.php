<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $fillabel = [

    'nik',
    'name',
    'phone',
    'position',
    
   ];

   public function payrolls()
   {
      return $this->hasMany(Payroll::class);
   }

}

