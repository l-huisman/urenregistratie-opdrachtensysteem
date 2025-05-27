<?php

namespace App\Policies;

use App\Models\User;

abstract class BasePolicy
{
    protected function isAdmin(User $user): bool
    {
        return $user->role->slug === 'administrator';
    }

    protected function isAdminOrManager(User $user): bool
    {
        return in_array($user->role->slug, ['manager', 'administrator']);
    }

    protected function isSelf(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

//    protected function isOwner(User $user, $model): bool
//    {
//        return true; // TODO: Look into implementing a more generic ownership check
//    }
}
