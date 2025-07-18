<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceHistory extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'employee_id',
        'attendance_id',
        'date_attendance',
        'attendance_type',
        'description',
    ];

    /**
     * Relasi: AttendanceHistory milik satu Employee.
     * Menggunakan 'employee_id' sebagai foreign key (bukan PK).
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * Relasi: AttendanceHistory milik satu Attendance.
     * Menggunakan 'attendance_id' sebagai foreign key (bukan PK).
     */
    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id', 'attendance_id');
    }
}
