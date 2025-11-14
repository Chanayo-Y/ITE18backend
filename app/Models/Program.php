<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $primaryKey = 'programID';
    public $timestamps = false;

    protected $fillable = ['program_code', 'program_name'];

    public function Student()
    {
        return $this->hasMany(Student::class, 'programID');
    }
}