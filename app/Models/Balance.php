<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'balances';
    protected $primaryKey = 'balanceID';
    public $timestamps = false;

    protected $fillable = ['studentID', 'amount', 'statusID'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusID');
    }
}