<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;

class AttendanceHistoryController extends Controller
{
    // GET /log-absensi
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date',
            'department_id' => 'nullable|integer|exists:departments,id'
        ]);

        $query = Attendance::with(['employee.department']);

        if ($request->filled('date')) {
            $query->whereDate('clock_in', $request->date);
        }

        if ($request->filled('department_id')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('department_id', $request->department_id);
            });
        }

        $attendances = $query->get()->map(function ($attendance) {
            $maxIn = $attendance->employee->department->max_clock_in_time;
            $maxOut = $attendance->employee->department->max_clock_out_time;

            return [
                'employee_id' => $attendance->employee_id,
                'name' => $attendance->employee->name,
                'clock_in' => $attendance->clock_in,
                'clock_out' => $attendance->clock_out,
                'tepat_masuk' => optional($attendance->clock_in)->format('H:i:s') <= $maxIn ? 'Tepat' : 'Terlambat',
                'tepat_keluar' => optional($attendance->clock_out)->format('H:i:s') >= $maxOut ? 'Tepat' : 'Terlambat',
            ];
        });

        return response()->json([
            'data' => $attendances
        ]);
    }
}
