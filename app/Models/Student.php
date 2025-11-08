<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'studentID';
    public $timestamps = false;

    protected $fillable = [
        'studentID', 'programID', 'yearID', 'userID', 'statusID'
    ];

    // relationships
    public function program()
    {
        return $this->belongsTo(Program::class, 'programID');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'yearID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusID');
    }

    public function balance()
    {
        return $this->hasMany(Balance::class, 'studentID');
    }

    public function enrollment()
    {
        return $this->hasMany(Enrollment::class, 'studentID');
    }

    public function clearance()
    {
        return $this->hasMany(Clearance::class, 'studentID');
    }

    public function transcript()
    {
        return $this->hasMany(Transcript::class, 'studentID');
    }

    public function activeAccount()
    {
        return $this->hasMany(Activate_Account::class, 'studentID');
    }
}
