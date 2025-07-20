@csrf
<div class="mb-4">
    <label>Nama Departemen</label>
    <input type="text" name="department_name" class="border w-full"
        value="{{ old('department_name', $department->department_name ?? '') }}" required>
</div>

<div class="mb-4">
    <label>Jam Maksimum Masuk</label>
    <input type="time" name="max_clock_in_time" class="border w-full"
        value="{{ old('max_clock_in_time', isset($department) ? \Carbon\Carbon::parse($department->max_clock_in_time)->format('H:i') : '') }}"
        required>
</div>


<div class="mb-4">
    <label>Jam Maksimum Keluar</label>
    <input type="time" name="max_clock_out_time" class="border w-full"
        value="{{ old('max_clock_out_time', isset($department) ? \Carbon\Carbon::parse($department->max_clock_out_time)->format('H:i') : '') }}"
        required>
</div>

<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
    {{ $submit ?? 'Simpan' }}
</button>
