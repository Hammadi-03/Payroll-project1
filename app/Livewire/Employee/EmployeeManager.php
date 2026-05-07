<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;

class EmployeeManager extends Component
{
    // Menyimpan ID karyawan (null = mode tambah, ada nilai = mode edit)
    public ?int $employee_id = null;

     // Penanda apakah sedang dalam mode edit
    public bool $isEditMode = false;

    // Properti yang terhubung dengan input form (binding Livewire)
    public string $nik ='';
    public string $name = '';
    public string $phone = '';
    public string $position ='';
    public string $department = '';
    public $basic_salary = 0;


    // create/update data

    public function store(){
        // validasi input form
        // NIK harus unik, tapi dikecualikan jika sedang edit data sendiri

        $this->validate([
            'nik' => 'required|unique:employees,nik,' . $this->employee_id,
            'name' => 'required|min:3',
            'phone' => 'required',
            'position' => 'required|min:3',
            'department' => 'required',
            'basic_salary' => 'required|numeric|min:0',
        ],[
            // Custom pesan error
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah digunakan oleh karyawan lain.',
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'phone.required' => 'No. Telepon wajib diisi.',
            'position.required' => 'Jabatan wajib diisi.',
            'position.min' => 'Jabatan minimal 3 karakter.',
            'department.required' => 'Departemen wajib diisi.',
            'basic_salary.required' => 'Gaji pokok wajib diisi.',
            'basic_salary.numeric' => 'Gaji pokok harus berupa angka.',
        ]);

        //Simpan atau update data karyawan
        // Jika employee_id null, berarti tambah data baru, jika ada nilai berarti update data lama
        Employee::updateOrCreate(
            ['id' => $this->employee_id], // Kondisi untuk update (cari data berdasarkan ID)
            [
                'nik' => $this->nik,
                'name' => $this->name,
                'phone' => $this->phone,
                'position' => $this->position,
                'department' => $this->department,
                'basic_salary' => $this->basic_salary,
            ] // Data yang akan disimpan atau diupdate
        );

        // Flash message untuk notifikasi sukses
        session()->flash(
            'success',
            $this->isEditMode 
            ? 'Data karyawan berhasil diperbarui.' 
            : 'Data karyawan berhasil ditambahkan.'
        );

        // Reset form setelah simpan
        $this->resetForm();

    }
    // 2. Siapkan form Edit
    public function edit(int $id)
    {
        $emp = Employee::findOrFail($id);
        $this->employee_id = $emp->id;
        $this->nik         = $emp->nik;
        $this->name        = $emp->name;
        $this->phone       = $emp->phone;
        $this->position    = $emp->position;
        $this->department  = $emp->department;
        $this->basic_salary = $emp->basic_salary;
        $this->isEditMode  = true;
    }

    // 3. DELETE
    public function delete(int $id)
    {
        Employee::findOrFail($id)->delete();
        session()->flash('success', 'Karyawan berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->reset(['employee_id', 'nik', 'name', 'phone', 'position', 'department', 'basic_salary', 'isEditMode']);
        $this->resetValidation();
    }

    // 4. READ
    public function render()
    {
        return view('livewire.employee.employee-manager', [
            'employees' => Employee::orderBy('id', 'desc')->get(),
        ])->layout('layouts.app');
    }
}