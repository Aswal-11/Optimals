<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name',  'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
                    ->withPivot('table_name');
    }

    public function subusers()
    {
        return $this->hasMany(SubUser::class);
    }
}
