@if (!isset($attendance))
    {{-- Form Absen Masuk --}}
    <div class="mb-4">
        <label class="block mb-1">Departemen</label>
        <select name="department_id" id="department-select" class="border w-full px-3 py-2 rounded" required>
            <option value="">-- Pilih Departemen --</option>
            @foreach ($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Karyawan</label>
        <select name="employee_id" id="employee-select" class="border w-full px-3 py-2 rounded" required>
            <option value="">-- Pilih Karyawan --</option>
            {{-- Karyawan akan dimuat via JS --}}
        </select>
    </div>
@else
    {{-- Form Absen Keluar --}}
    <div class="mb-4">
        <label class="block font-semibold">Nama Karyawan:</label>
        <p>{{ $attendance->employee->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Jam Masuk:</label>
        <p>{{ $attendance->clock_in }}</p>
    </div>
@endif

<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    {{ $submit }}
</button>
