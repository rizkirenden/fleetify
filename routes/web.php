<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);

// Attendance
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::get('/attendances/{attendance_id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
Route::post('/absen-masuk', [AttendanceController::class, 'store'])->name('attendance.store');
Route::put('/absen-keluar/{attendance_id}', [AttendanceController::class, 'update'])->name('attendance.update');
Route::get('/attendance/history', [AttendanceHistoryController::class, 'index'])->name('attendance.history');

// Log absensi
Route::get('/log-absensi', [AttendanceHistoryController::class, 'index']);
