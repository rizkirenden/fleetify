@extends('layouts.app')

@section('title', 'Attendance History')

@section('content')
    <div class="p-6 space-y-6">
        <h2 class="text-xl font-semibold text-gray-800">Attendance History</h2>

        <form method="GET" action="{{ route('attendance.history') }}" class="flex gap-4 mb-6">
            <div class="flex-1">
                <label class="block mb-1">Date</label>
                <input type="date" name="date" value="{{ request('date') }}" class="border rounded px-3 py-2 w-full">
            </div>
            <div class="flex-1">
                <label class="block mb-1">Department</label>
                <select name="department_id" class="border rounded px-3 py-2 w-full">
                    <option value="">All Departments</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ request('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="self-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </div>
        </form>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($histories as $history)
                        <tr>
                            <td class="px-6 py-4">{{ $history->employee->name }}</td>
                            <td class="px-6 py-4">{{ $history->employee->department->department_name }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($history->date_attendance)->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4">
                                @if ($history->attendance_type == 1)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Clock In</span>
                                @else
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">Clock Out</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $history->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No history found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
