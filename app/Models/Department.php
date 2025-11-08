<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'deptID';
    public $timestamps = false;

    protected $fillable = ['dept_name'];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'deptID');
    }

    public function clearance()
    {
        return $this->hasMany(Clearance::class, 'deptID');
    }
}
