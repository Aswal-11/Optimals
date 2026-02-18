<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'name',
        'age',
        'password',
        'email',
        'designation_id',
        'salary'
    ];

    protected $hidden = [
        'password',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
