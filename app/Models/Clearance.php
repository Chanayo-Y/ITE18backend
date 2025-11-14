<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $table = 'clearances';
    protected $primaryKey = 'clearanceID';
    public $timestamps = false;

    protected $fillable = ['studentID','statusID', 'departmentID'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'deptID');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusID');
    }
}