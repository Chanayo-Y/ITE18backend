<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $primaryKey = 'rateID';
    public $timestamps = false;

    protected $fillable = ['employeeID', 'rateValue', 'description'];

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'rateID');
    }
}