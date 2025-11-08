<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Class_Sched extends Model
{
    protected $table = 'class_sched';
    protected $primaryKey = 'schedID';
    public $timestamps = false;

    protected $fillable = [
        'employeeID', 'roomID', 'subjectID'
    ];

    public function teacher()
    {
        return $this->belongsTo(Employee::class, 'employeeID');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'roomID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subID');
    }
}
