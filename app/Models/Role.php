<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'roleID';
    public $timestamps = false;

    protected $fillable = ['role_name'];

    public function users()
    {
        return $this->hasMany(User::class, 'roleID');
    }
}