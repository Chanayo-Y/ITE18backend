<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'appointID';
    public $timestamps = false;

    protected $fillable = [
        'statusID', 'userID','employeeID'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeID');
    }
}