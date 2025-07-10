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

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdministrator($user) || $this->isClient($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $this->isAdministrator($user) || $this->isProjectOfClient($user, $project);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        return $this->isAdministrator($user) || $this->isClientOfCompany($user, $project->company);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return $this->isAdministrator($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return $this->isAdministrator($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false; // Not allowed by default
    }
}
