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
        'is_active',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: JobPost belongs to Designation
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
