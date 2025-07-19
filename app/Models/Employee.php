<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
        'name',
        'address',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
    }

    public function attendanceHistories()
    {
        return $this->hasMany(AttendanceHistory::class, 'employee_id', 'employee_id');
    }
}
