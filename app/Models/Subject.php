<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'subjectID';
    public $timestamps = false;

    protected $fillable = [
        'userID','subj_code', 'subj_name', 'units'
    ];

    public function classSched()
    {
        return $this->hasMany(Class_Sched::class, 'subID');
    }

    public function transcript()
    {
        return $this->hasMany(Transcript::class, 'subID');
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'subID');
    }
}
