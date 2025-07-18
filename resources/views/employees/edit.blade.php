@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')
    <div class="p-4">
        <h1 class="text-xl mb-4">Edit Karyawan</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('employees.form', ['submit' => 'Update', 'employee' => $employee])
        </form>
    </div>
@endsection
