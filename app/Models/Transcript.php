<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    protected $table = 'transcripts';
    protected $primaryKey = 'transcriptID';
    public $timestamps = false;

    protected $fillable = ['gradeID', 'studentID'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subID');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'gradeID');
    }
}