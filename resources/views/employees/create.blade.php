@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
    <div class="p-4">
        <h1 class="text-xl mb-4">Tambah Karyawan</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @include('employees.form', ['submit' => 'Simpan'])
        </form>
    </div>
@endsection
