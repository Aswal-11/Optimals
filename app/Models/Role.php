<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'table_name', 'permission_id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)
                    ->withPivot('table_name');
    }

    public function subusers()
    {
        return $this->hasMany(Subuser::class);
    }
}
