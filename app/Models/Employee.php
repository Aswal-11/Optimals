<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'age',
        'email',
        'designation_id',
        'salary'
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
