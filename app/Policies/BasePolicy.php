<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Concerns\ChecksOwner;
use App\Policies\Concerns\ChecksRoles;

class BasePolicy
{
    use ChecksRoles;
    use ChecksOwner;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    protected function isAdministrator(User $user): bool
    {
        return $user->role->slug === 'administrator';
    }

    protected function isManager(User $user): bool
    {
        return $user->role->slug === 'manager';

    }

    protected function isSelf(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    protected function isAdministratorOrManager(User $user): bool
    {
        return in_array($user->role->slug, ['administrator', 'manager']);
    }
}

