<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function skills()
    {
      return $this->belongsToMany(Skill::class);
    }
}
