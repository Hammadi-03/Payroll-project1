<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            // Menyambungkan tabel ini dengan tabel employess
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();

            // Komponen angka - Decimal 15 digit dengan 2 angka di belakang koma untuk presisi Uang
            $table->decimal('basic_salary', 15, 2)->default(0);   // Gaji Pokok
            $table->decimal('allowance', 15, 2)->default(0);      // Total Tunjangan
            $table->decimal('deduction', 15, 2)->default(0);      // Total Potongan
            $table->decimal('net_salary', 15, 2)->default(0);     // Gaji Bersih Terakhir (Take Home Pay)
        
            $table->string('month_year'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
