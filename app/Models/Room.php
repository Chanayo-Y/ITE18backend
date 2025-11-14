<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'roomID';
    public $timestamps = false;

    protected $fillable = ['room_name', 'roomtype', 'schedID'];

    public function class_sched()
    {
        return $this->belongsTo(Class_Sched::class, 'schedID');
    }
}