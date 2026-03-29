<?php

namespace App\Policies;

// Models

// Services
use App\services\PermissionService;

class EmployeePolicy
{
    protected $permission;

    /**
     * Create a new policy instance.
     */
    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    public function viewAny($user)
    {
        return $this->permission->check($user, 'read', 'employees');
    }

    public function view($user, $employee)
    {
        return $this->permission->check($user, 'read', 'employees');
    }

    public function create($user)
    {
        return $this->permission->check($user, 'create', 'employees');
    }

    public function update($user, $employee)
    {
        return $this->permission->check($user, 'update', 'employees');
    }

    public function delete($user, $employee)
    {
        return $this->permission->check($user, 'delete', 'employees');
    }
}
