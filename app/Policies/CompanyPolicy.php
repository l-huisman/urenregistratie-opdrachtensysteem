<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Company $model
     * @return bool
     */
    public function view(User $user, $model): bool
    {
        return $this->isAdministrator($user) || $this->isManager($user); // TODO: || $this->isPartOf($user, $model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $this->isAdministrator($user) || $this->isManager($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Company $model
     * @return bool
     */
    public function update(User $user, $model): bool
    {
        return $this->isAdministrator($user) || $this->isManager($user); // TODO: || $this->isPartOf($user, $model);
    }
}
