<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// ✅ Route ini HANYA bisa diakses jika sudah login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('employee', 'employee.index')->name('employee.index');
    Route::view('payroll', 'payroll.index')->name('payroll.index');
    Route::get('editkaryawan', \App\Livewire\Employee\EmployeeManager::class)->name('employee.edit');
    Route::get('kalkulator-penggajian', \App\Livewire\Calculator\PayrollCalculator::class)->name('payroll.calculator');
});

require __DIR__ . '/auth.php';