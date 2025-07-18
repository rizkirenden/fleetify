@csrf
<div class="mb-4">
    <label class="block mb-1">ID Karyawan</label>
    <input type="text" name="employee_id" class="border w-full px-2 py-1"
        value="{{ old('employee_id', $employee->employee_id ?? '') }}" required>
</div>

<div class="mb-4">
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" class="border w-full px-2 py-1" value="{{ old('name', $employee->name ?? '') }}"
        required>
</div>

<div class="mb-4">
    <label class="block mb-1">Departemen</label>
    <select name="department_id" class="border w-full px-2 py-1" required>
        <option value="">-- Pilih Departemen --</option>
        @foreach ($departments as $dept)
            <option value="{{ $dept->id }}"
                {{ old('department_id', $employee->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                {{ $dept->department_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block mb-1">Alamat</label>
    <textarea name="address" rows="3" class="border w-full px-2 py-1" required>{{ old('address', $employee->address ?? '') }}</textarea>
</div>

<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
    {{ $submit ?? 'Simpan' }}
</button>
