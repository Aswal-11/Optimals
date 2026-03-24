<?php

namespace App\Policies;

use App\Services\PermissionService;

class JobPostPolicy
{
    protected $permission;

    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    public function viewAny($user)
    {
        return $this->permission->check('read', 'job_posts');
    }

    public function view($user, $job)
    {
        return $this->permission->check('read', 'job_posts');
    }

    public function create($user)
    {
        return $this->permission->check('create', 'job_posts');
    }

    public function update($user, $job)
    {
        return $this->permission->check('update', 'job_posts');
    }

    public function delete($user, $job)
    {
        return $this->permission->check('delete', 'job_posts');
    }
}
