<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Department;
use App\Models\AttendanceHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendance.create', [
            'departments' => Department::all(),
            'employees' => Employee::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|exists:employees,employee_id',
            'client_time' => 'nullable|date'
        ]);

        $clockInTime = $request->filled('client_time')
            ? Carbon::parse($request->client_time)
            : now();

        $attendance = Attendance::create([
            'employee_id' => $request->employee_id,
            'attendance_id' => uniqid('att_'),
            'clock_in' => $clockInTime,
        ]);

        // Create history for clock in
        AttendanceHistory::create([
            'employee_id' => $request->employee_id,
            'attendance_id' => $attendance->attendance_id,
            'date_attendance' => $clockInTime,
            'attendance_type' => 1, // 1 for clock in
            'description' => 'Clock in at ' . $clockInTime->format('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Absen masuk berhasil',
            'data' => $attendance
        ], 201);
    }

    public function edit($attendance_id)
    {
        $attendance = Attendance::where('attendance_id', $attendance_id)->firstOrFail();
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $attendance_id)
    {
        $attendance = Attendance::where('attendance_id', $attendance_id)->firstOrFail();
        $clockOutTime = now();

        $attendance->update([
            'clock_out' => $clockOutTime
        ]);

        // Create history for clock out
        AttendanceHistory::create([
            'employee_id' => $attendance->employee_id,
            'attendance_id' => $attendance->attendance_id,
            'date_attendance' => $clockOutTime,
            'attendance_type' => 2, // 2 for clock out
            'description' => 'Clock out at ' . $clockOutTime->format('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Absen keluar berhasil',
            'data' => $attendance
        ]);
    }
}
