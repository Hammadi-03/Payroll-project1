@if(session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="p-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-4">
            <i class="fa-solid fa-users text-blue-500 mr-2"></i>
            {{ $isEditMode ? 'Edit Karyawan' : 'Tambah Karyawan' }}
        </h3>
        
        <form wire:submit="store" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" wire:model.blur="nik" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" wire:model.blur="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input type="text" wire:model.blur="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" wire:model.blur="position" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('position') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Departemen</label>
                    <input type="text" wire:model.blur="department" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('department') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                    <input type="number" wire:model.blur="basic_salary" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('basic_salary') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <button type="button" wire:click="resetForm" 
                    class="group relative flex items-center px-6 py-2.5 bg-gradient-to-b from-gray-400 to-gray-600 text-white font-semibold rounded-full shadow-[0_4px_0_0_rgba(0,0,0,0.2)] hover:shadow-[0_2px_0_0_rgba(0,0,0,0.2)] hover:translate-y-[2px] transition-all active:shadow-none active:translate-y-[4px]">
                    <span class="absolute inset-0 w-full h-full bg-white/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <i class="fa-solid fa-rotate-left mr-2"></i> Reset
                </button>
                <button type="submit" 
                    class="group relative flex items-center px-8 py-2.5 bg-gradient-to-b from-blue-400 to-blue-600 text-white font-semibold rounded-full shadow-[0_4px_0_0_rgba(0,0,0,0.2)] hover:shadow-[0_2px_0_0_rgba(0,0,0,0.2)] hover:translate-y-[2px] transition-all active:shadow-none active:translate-y-[4px]">
                    <span class="absolute inset-0 w-full h-full bg-white/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    @if($isEditMode)
                        <i class="fa-solid fa-user-pen mr-2"></i> Update
                    @else
                        <i class="fa-solid fa-user-plus mr-2"></i> Simpan
                    @endif
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <h3 class="text-xl font-bold mb-4">
            <i class="fa-solid fa-list text-gray-700 mr-2"></i> Daftar Karyawan
        </h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji Pokok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->nik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->position }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($employee->basic_salary, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <button wire:click="edit({{ $employee->id }})" 
                                class="inline-flex items-center px-4 py-1.5 bg-gradient-to-b from-indigo-400 to-indigo-600 text-white rounded-full shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all active:translate-y-0" title="Edit">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </button>
                            <button wire:click="delete({{ $employee->id }})" wire:confirm="Yakin ingin menghapus karyawan ini?" 
                                class="inline-flex items-center px-4 py-1.5 bg-gradient-to-b from-red-400 to-red-600 text-white rounded-full shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all active:translate-y-0" title="Hapus">
                                <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data karyawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>