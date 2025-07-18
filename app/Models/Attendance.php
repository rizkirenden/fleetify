<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'employee_id',
        'attendance_id',
        'clock_in',
        'clock_out',
    ];

    /**
     * Relasi: Attendance milik satu Employee.
     * Relasi ini menggunakan employee_id sebagai foreign key (bukan id).
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * Relasi: Attendance memiliki banyak AttendanceHistory.
     */
    public function histories()
    {
        return $this->hasMany(AttendanceHistory::class, 'attendance_id', 'attendance_id');
    }
}
