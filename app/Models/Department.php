<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi massal (mass assignable)
     */
    protected $fillable = [
        'department_name',
        'max_clock_in_time',
        'max_clock_out_time',
    ];

    /**
     * Relasi: Satu department memiliki banyak employee
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
