@extends('layouts.app')

@section('title', 'Tambah Attendance')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Tambah Attendance</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            @include('attendance.form', [
                'submit' => 'Absen Masuk',
                'departments' => $departments,
                'employees' => $employees,
            ])
        </form>
        <script>
            document.getElementById('department-select').addEventListener('change', function() {
                const departmentId = this.value;
                console.log("Selected department:", departmentId);

                const employeeSelect = document.getElementById('employee-select');
                employeeSelect.innerHTML = '<option value="">-- Pilih Karyawan --</option>';

                if (departmentId) {
                    fetch(`/employees-by-department/${departmentId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log("Employee data:", data);
                            if (data.length > 0) {
                                data.forEach(employee => {
                                    const option = document.createElement('option');
                                    option.value = employee.employee_id;
                                    option.text = employee.name;
                                    employeeSelect.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = "";
                                option.text = "Tidak ada karyawan di departemen ini";
                                employeeSelect.appendChild(option);
                            }
                        });
                }
            });
            document.getElementById('clientTime').value = new Date().toISOString();
        </script>
    </div>
@endsection
