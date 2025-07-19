<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // POST /absen-masuk
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|exists:employees,employee_id',
        ]);

        $attendance = Attendance::create([
            'employee_id' => $request->employee_id,
            'attendance_id' => uniqid('att_'),
            'clock_in' => now(),
        ]);

        return response()->json([
            'message' => 'Absen masuk berhasil',
            'data' => $attendance
        ], 201);
    }

    // PUT /absen-keluar/{attendance_id}
    public function update(Request $request, $attendance_id)
    {
        $attendance = Attendance::where('attendance_id', $attendance_id)->firstOrFail();

        $attendance->update([
            'clock_out' => now()
        ]);

        return response()->json([
            'message' => 'Absen keluar berhasil',
            'data' => $attendance
        ]);
    }
}

