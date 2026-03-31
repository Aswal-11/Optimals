<?php

namespace App\Policies;

use App\Models\Designation;
use App\Services\PermissionService;

class DesignationPolicy
{
    protected PermissionService $permission;

    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    public function viewAny($user): bool
    {
        return $this->permission->check($user, 'read', 'designations');
    }

    public function view($user, Designation $designation): bool
    {
        return $this->permission->check($user, 'read', 'designations');
    }

    public function create($user): bool
    {
        return $this->permission->check($user, 'create', 'designations');
    }

    public function update($user, Designation $designation): bool
    {
        return $this->permission->check($user, 'update', 'designations');
    }

    public function delete($user, Designation $designation): bool
    {
        return $this->permission->check($user, 'delete', 'designations');
    }
}
