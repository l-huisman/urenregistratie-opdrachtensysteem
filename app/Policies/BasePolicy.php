<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Concerns\CheckOwner;
use App\Policies\Concerns\ChecksRoles;

abstract class BasePolicy
{
    use ChecksRoles, CheckOwner;

    protected function isAdmin(User $user): bool
    {
        return $user->role->slug === 'administrator';
    }

    protected function isAdminOrManager(User $user): bool
    {
        return in_array($user->role->slug, ['manager', 'administrator']);
    }

    protected function isSelf(User $user, $model): bool
    {
        return $user->id === $model->id;
    }


//    protected function isOwner(User $user, $model): bool
//    {
//        return true; // TODO: Look into implementing a more generic ownership check
//    }

    public function viewAny(User $user): bool
    {
        return $this->isAdminOrManager($user);
    }

    public function view(User $user, $model): bool
    {
        return $this->isAdminOrManager($user) || $this->isSelf($user, $model);
    }

    public function create(User $user): bool
    {
        return $this->isAdminOrManager($user);
    }

    public function update(User $user, $model): bool
    {
        return $this->isAdminOrManager($user) || $this->isSelf($user, $model);
    }

    public function delete(User $user, $model): bool
    {
        return $this->isAdmin($user);
    }

    public function restore(User $user, $model): bool
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, $model): bool
    {
        return false; // Default to not allowing force delete
    }
}
