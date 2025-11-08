<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'evaluaID';
    public $timestamps = false;

    protected $fillable = ['studentID', 'rateID', 'employeeID'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeID');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rateID');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
}
