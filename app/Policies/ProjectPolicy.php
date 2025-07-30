<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Policies\Concerns\ChecksClientCompany;
use App\Policies\Concerns\ChecksOwnership;
use App\Policies\Concerns\ChecksRoles;
use App\Policies\Concerns\ChecksSelf;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    use ChecksRoles, ChecksSelf, ChecksClientCompany, ChecksOwnership;

    public function viewAny(User $user): bool
    {
        return $this->isAdministrator($user) || $this->isClient($user);
    }

    public function view(User $user, Project $project): bool
    {
        return $this->isAdministrator($user) || $this->isProjectOfClient($user, $project);
    }

    public function create(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    public function update(User $user, Project $project): bool
    {
        return $this->isAdministrator($user) || $this->isClientOfCompany($user, $project->company);
    }

    public function delete(User $user, Project $project): bool
    {
        return $this->isAdministrator($user);
    }

    public function restore(User $user, Project $project): bool
    {
        return $this->isAdministrator($user);
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return false; // Not allowed by default
    }
}
