<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'designation_id',
        'description',
        'location',
        'salary',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
