<div class="max-w-2xl mx-auto py-8 px-4">

    <!-- Flash sukses -->
    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-6">🧮 Kalkulator Penggajian</h2>

        <form wire:submit="savePayroll">

            <!-- Pilih Karyawan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Karyawan</label>
                <select wire:model="employee_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->nik }} — {{ $emp->name }}</option>
                    @endforeach
                </select>
                @error('employee_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Periode Gaji (bisa diedit) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Periode Gaji</label>
                <input type="text" wire:model="month_year" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="April 2026">
                @error('month_year') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Input Nominal — wire:model.live agar kalkulator langsung bereaksi -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                <input type="number" wire:model.live="basic_salary" min="0" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="0">
                @error('basic_salary') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tunjangan</label>
                <input type="number" wire:model.live="allowance" min="0" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="0">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Potongan (BPJS, Pajak, dll)</label>
                <input type="number" wire:model.live="deduction" min="0" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="0">
            </div>

            <!-- Take Home Pay: berubah otomatis tanpa klik tombol apapun -->
            <div class="border-t pt-4 mb-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Take Home Pay (THP)</p>
                    <p class="text-xs text-gray-400">Gaji Pokok + Tunjangan - Potongan</p>
                </div>
                <div class="text-3xl font-extrabold text-blue-600">
                    Rp {{ number_format($net_salary, 0, ',', '.') }}
                </div>
            </div>

            <button type="submit"
                wire:loading.attr="disabled"
                class="group relative w-full overflow-hidden flex items-center justify-center px-8 py-3 bg-gradient-to-b from-blue-400 to-blue-700 text-white font-bold rounded-full shadow-[0_4px_0_0_rgba(0,0,0,0.2)] hover:shadow-[0_2px_0_0_rgba(0,0,0,0.2)] hover:translate-y-[2px] transition-all active:shadow-none active:translate-y-[4px] disabled:opacity-50">
                <span class="absolute inset-0 w-full h-full bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                <span wire:loading.remove class="flex items-center">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Slip Gaji
                </span>
                <span wire:loading class="flex items-center">
                    <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Menyimpan...
                </span>
            </button>

        </form>
    </div>
</div>
