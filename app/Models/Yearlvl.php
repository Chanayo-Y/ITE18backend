<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yearlvl extends Model
{
    protected $table = 'years';
    protected $primaryKey = 'yearID';
    public $timestamps = false;

    protected $fillable = ['yearlvl'];

    public function student()
    {
        return $this->hasMany(Student::class, 'yearID');
    }
}