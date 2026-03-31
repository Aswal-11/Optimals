<?php

namespace App\Policies;

use App\Models\SubUser;
use App\Services\PermissionService;

class SubUserPolicy
{
    protected PermissionService $permission;

    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    public function viewAny($user): bool
    {
        return $this->permission->check($user, 'read', 'sub_users');
    }

    public function view($user, SubUser $subuser): bool
    {
        return $this->permission->check($user, 'read', 'sub_users');
    }

    public function create($user): bool
    {
        return $this->permission->check($user, 'create', 'sub_users');
    }

    public function update($user, SubUser $subuser): bool
    {
        return $this->permission->check($user, 'update', 'sub_users');
    }

    public function delete($user, SubUser $subuser): bool
    {
        return $this->permission->check($user, 'delete', 'sub_users');
    }
}
