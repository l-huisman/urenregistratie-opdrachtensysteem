<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Concerns\ChecksRoles;
use App\Policies\Concerns\ChecksSelf;

class UserPolicy
{
    use ChecksRoles, ChecksSelf;

    public function viewAny(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    public function view(User $user, User $model): bool
    {
        return $this->isAdministrator($user) || $user->is($model);
    }

    public function create(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    public function update(User $user, User $model): bool
    {
        return $this->isAdministrator($user) || $user->is($model);
    }

    public function delete(User $user, User $model): bool
    {
        return $this->isAdministrator($user);
    }

    public function restore(User $user, User $model): bool
    {
        return $this->isAdministrator($user);
    }
}
