<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ChecksRoles
{
    protected function isAdministrator(User $user): bool
    {
        return $user->role->slug === 'administrator';
    }
}

