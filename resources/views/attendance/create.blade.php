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
            document.getElementById('clientTime').value = new Date().toISOString();
            // atau format lain yang sesuai
        </script>
    </div>
@endsection
