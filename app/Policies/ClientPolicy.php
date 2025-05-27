<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Client $model
     * @return bool
     */
    public function view(User $user, $model): bool
    {
        return true; // TODO refactor this to use inheritance on the Client model from User model
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Client $model
     * @return bool
     */
    public function update(User $user, $model): bool
    {
        return $this->isAdminOrManager($user); // TODO also add check for self for client when inheritance is implemented
    }
}
