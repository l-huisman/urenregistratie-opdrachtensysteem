<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ChecksSelf
{
    protected function isSelf(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }
}

