@extends('layouts.app')

@section('title', 'Absen Keluar')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Absen Keluar</h1>

        <form action="{{ route('attendance.update', $attendance->attendance_id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('attendance.form', [
                'submit' => 'Absen Keluar',
                'attendance' => $attendance,
            ])
        </form>
    </div>
@endsection
