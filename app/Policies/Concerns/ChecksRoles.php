<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ChecksRoles
{
    protected function isAdministrator(User $user): bool
    {
        return $user->role->slug === 'administrator';
    }

    protected function isManager(User $user): bool
    {
        return $user->role->slug === 'manager';
    }

    protected function isAdministratorOrManager(User $user): bool
    {
        return in_array($user->role->slug, ['administrator', 'manager']);
    }
}

