@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">

        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Attendance</h2>
            <a href="{{ route('attendance.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Absen Masuk
            </a>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
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
                    @forelse ($attendances as $attendance)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{ $attendance->employee->name }}</td>
                            <td class="px-4 py-2">{{ $attendance->clock_in }}</td>
                            <td class="px-4 py-2">
                                {{ $attendance->clock_out ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if (is_null($attendance->clock_out))
                                    <a href="{{ route('attendance.edit', $attendance->attendance_id) }}"
                                        class="inline-block text-sm text-red-600 hover:text-red-800 font-medium">
                                        🕔 Absen Pulang
                                    </a>
                                @else
                                    <span class="text-green-600 font-semibold">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-400 px-4 py-6">
                                Tidak ada data attendance.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
