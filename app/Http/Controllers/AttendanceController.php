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

    public function getEmployeesByDepartment($department_id)
{
    $employees = Employee::where('department_id', $department_id)
        ->select('employee_id', 'name')
        ->get();

    return response()->json($employees);
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

    $employee = Employee::findOrFail($request->employee_id);
    $maxClockInTime = Carbon::parse($employee->department->max_clock_in_time);
    $clockInStatus = $clockInTime->format('H:i:s') > $maxClockInTime->format('H:i:s')
        ? 'Terlambat'
        : 'Tepat waktu';

    $attendance = Attendance::create([
        'employee_id' => $request->employee_id,
        'attendance_id' => uniqid('att_'),
        'clock_in' => $clockInTime,
    ]);

    AttendanceHistory::create([
        'employee_id' => $request->employee_id,
        'attendance_id' => $attendance->attendance_id,
        'date_attendance' => $clockInTime,
        'attendance_type' => 1,
        'description' => 'Status: ' . $clockInStatus .
                        ' (Max: ' . $maxClockInTime->format('H:i') . ')'
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

    $employee = $attendance->employee;
    $maxClockOutTime = Carbon::parse($employee->department->max_clock_out_time);
    $clockOutStatus = $clockOutTime->format('H:i:s') < $maxClockOutTime->format('H:i:s')
        ? 'Pulang cepat'
        : 'Tepat waktu';

    $attendance->update([
        'clock_out' => $clockOutTime
    ]);

    AttendanceHistory::create([
        'employee_id' => $attendance->employee_id,
        'attendance_id' => $attendance->attendance_id,
        'date_attendance' => $clockOutTime,
        'attendance_type' => 2,
        'description' => 'Status: ' . $clockOutStatus .
                        ' (Min: ' . $maxClockOutTime->format('H:i') . ')'
    ]);

    return response()->json([
        'message' => 'Absen keluar berhasil',
        'data' => $attendance
    ]);
}
}
