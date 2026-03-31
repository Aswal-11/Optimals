<?php

namespace App\Policies;

use App\Models\Skill;
use App\Services\PermissionService;

class SkillPolicy
{
    protected PermissionService $permission;

    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    public function viewAny($user): bool
    {
        return $this->permission->check($user, 'read', 'skills');
    }

    public function view($user, Skill $skill): bool
    {
        return $this->permission->check($user, 'read', 'skills');
    }

    public function create($user): bool
    {
        return $this->permission->check($user, 'create', 'skills');
    }

    public function update($user, Skill $skill): bool
    {
        return $this->permission->check($user, 'update', 'skills');
    }

    public function delete($user, Skill $skill): bool
    {
        return $this->permission->check($user, 'delete', 'skills');
    }
}
