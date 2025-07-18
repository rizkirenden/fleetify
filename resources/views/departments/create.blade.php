@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h1 class="text-xl mb-4">Tambah Departemen</h1>
        <form action="{{ route('departments.store') }}" method="POST">
            @include('departments.form', ['submit' => 'Tambah'])
        </form>
    </div>
@endsection
