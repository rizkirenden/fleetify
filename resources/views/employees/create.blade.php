@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
    <div class="p-4">
        <h1 class="text-xl mb-4">Tambah Karyawan</h1>
        <form action="{{ route('employees.store') }}" method="POST">
            @include('employees.form', ['submit' => 'Simpan'])
        </form>
    </div>
@endsection
