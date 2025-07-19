<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Department;
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

    // POST /absen-masuk
  public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|string|exists:employees,employee_id',
        'client_time' => 'nullable|date' // Optional, tapi harus format date/time valid
    ]);

    $attendance = Attendance::create([
        'employee_id' => $request->employee_id,
        'attendance_id' => uniqid('att_'),
        'clock_in' => $request->filled('client_time')
            ? Carbon::parse($request->client_time)
            : now(),
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

