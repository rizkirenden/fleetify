@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Edit Departemen</h1>
        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('departments.form', ['submit' => 'Update', 'department' => $department])
        </form>
    </div>
@endsection
