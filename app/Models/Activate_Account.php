<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activate_Account extends Model
{
    protected $table = 'activate_accounts';
    protected $primaryKey = 'activateID';
    public $timestamps = false;

    protected $fillable = ['activated_at', 'studentID'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
}
