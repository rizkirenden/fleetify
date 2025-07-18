<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi secara massal.
     */
    protected $fillable = [
        'employee_id',
        'department_id',
        'name',
        'address',
    ];

    /**
     * Relasi: Employee milik satu Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Relasi: Employee memiliki banyak Attendance
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
    }

    /**
     * Relasi: Employee memiliki banyak AttendanceHistory
     */
    public function attendanceHistories()
    {
        return $this->hasMany(AttendanceHistory::class, 'employee_id', 'employee_id');
    }
}
