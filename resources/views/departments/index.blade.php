@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">

        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Departemen</h2>
            <a href="{{ route('departments.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Departemen
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border rounded-lg overflow-hidden shadow-sm bg-white">
                <thead class="bg-gray-50 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Jam Keluar</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse ($departments as $dept)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{ $dept->department_name }}</td>
                            <td class="px-4 py-2">{{ $dept->max_clock_in_time }}</td>
                            <td class="px-4 py-2">{{ $dept->max_clock_out_time }}</td>
                            <td class="px-4 py-2 flex items-center gap-2">
                                <a href="{{ route('departments.edit', $dept->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('departments.destroy', $dept->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-400 px-4 py-6">Tidak ada data departemen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
