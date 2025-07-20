<?php

namespace App\Http\Controllers;

use App\Models\AttendanceHistory;
use App\Models\Department;
use Illuminate\Http\Request;

class AttendanceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date',
            'department_id' => 'nullable|integer|exists:departments,id'
        ]);

        $query = AttendanceHistory::with(['employee.department']);

        if ($request->filled('date')) {
            $query->whereDate('date_attendance', $request->date);
        }

        if ($request->filled('department_id')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('department_id', $request->department_id);
            });
        }

        $histories = $query->latest()->get();

        return view('attendance.history', [
            'histories' => $histories,
            'departments' => Department::all()
        ]);
    }
}
