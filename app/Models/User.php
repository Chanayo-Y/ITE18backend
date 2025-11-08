<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userID';
    public $timestamps = false;
    protected $fillable = [
        'userID', 'f_name', 'm_name', 'l_name', 'password', 'email',
        'gender', 'address', 'phoneNum', 'roleID'
    ];

    public function Role()
    {
        return $this->belongsTo(Role::class, 'roleID');
    }

    public function Student()
    {
        return $this->hasOne(Student::class, 'userID');
    }

    public function Employee()
    {
        return $this->hasOne(Employee::class, 'userID');
    }
}
