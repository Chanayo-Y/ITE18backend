<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'statusID';
    public $timestamps = false;

    protected $fillable = ['stats_name'];

    public function student()
    {
        return $this->hasMany(Student::class, 'statusID');
    }

    public function balance()
    {
        return $this->hasMany(Balance::class, 'statusID');
    }

    public function clearance()
    {
        return $this->hasMany(Clearance::class, 'statusID');
    }
}
