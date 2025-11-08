<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'gradeID';
    public $timestamps = false;

    protected $fillable = ['subjectID', 'grade'];

    public function transcript()
    {
        return $this->hasMany(Transcript::class, 'gradeID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subID');
    }
}
