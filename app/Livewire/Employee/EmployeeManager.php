<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;

class EmployeeManager extends Component
{
    public bool $isEditMode = false;
    public ?int $employee_id = null;
    public string $nik = '';
    public string $name = '';
    public string $phone = '';
    public string $position = '';


 public function store(){
    

    $this->validate([
        'nik' => 'require|unique:employees,nik,' . $this->employee_id,
        'name' => 'require|unique|min:3|max:100',
        'phone' => 'required',
        'position'=> 'required|min:3',

    ],[ 
        'nik.required' => 'NIK wajib diisi.',
        'nik.unique' => 'NIK suadh dipake oleh staff lain'

    ]);

    Employee::updateOrCreate(
        ['id'=> $this->employee_id],
        [
            'nik' => $this->nik,
            'name' => $this->name,
            'phone' => $this->phone,
            'position' => $this->position,
        ]
    );

       //falsh massage if Sucsess notification

       session()->flash(
        'sucsess',
        $this->isEditMode
         ? 'Data staff berhasil diperbarui.'
         : 'Data staff berhasil ditambahkan.'

       );

       
 }
    
    public function render()
    {
        return view('livewire.employee.employee-manager');
    }
}
