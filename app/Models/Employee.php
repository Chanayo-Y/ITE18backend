<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'employeeID';
    public $timestamps = false;

    protected $fillable = ['deptID','position', 'userID'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'deptID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'employeeID');
    }

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'employeeID');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'employeeID');
    }
}