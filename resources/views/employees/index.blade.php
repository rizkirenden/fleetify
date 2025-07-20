@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
    <div class="p-6 space-y-6">

        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Karyawan</h2>
            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Karyawan
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 bg-white rounded shadow-sm text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Departemen</th>
                        <th class="px-4 py-3 text-left">Alamat</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-800">
                    @forelse ($employees as $emp)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{ $emp->employee_id }}</td>
                            <td class="px-4 py-2">{{ $emp->name }}</td>
                            <td class="px-4 py-2">{{ $emp->department->department_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $emp->address }}</td>
                            <td class="px-4 py-2 flex gap-3">
                                <a href="{{ route('employees.edit', $emp->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                    ✏️ <span>Edit</span>
                                </a>
                                <form action="{{ route('employees.destroy', $emp->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                        🗑️ <span>Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 px-4 py-6">Belum ada data karyawan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
