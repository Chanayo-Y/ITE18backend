<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    public $timestamps = false;

    protected $fillable = ['studentID', 'semester', 'statusID', 'schedID'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'statusID');
    }
    public function Class_Sched()
    {
        return $this->belongsTo(Class_Sched::class, 'schedID');
    }
}