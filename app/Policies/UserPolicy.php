<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends BasePolicy
{
//    /**
//     * Determine whether the user can view any models.
//     */
//    public function viewAny(User $user): bool
//    {
//        return $this->isAdminOrManager($user);
//    }
//
//
//    /**
//     * Determine whether the user can view the model.
//     */
//    public function view(User $user, User $model): bool
//    {
//        return $this->isAdminOrManager($user) || $this->isSelf($user, $model);
//    }
//
//    /**
//     * Determine whether the user can create models.
//     */
//    public function create(User $user): bool
//    {
//        return $this->isAdminOrManager($user);
//    }
//
//    /**
//     * Determine whether the user can update the model.
//     */
//    public function update(User $user, User $model): bool
//    {
//        return $this->isAdminOrManager($user) || $this->isSelf($user, $model);
//    }
//
//    /**
//     * Determine whether the user can delete the model.
//     */
//    public function delete(User $user, User $model): bool
//    {
//        return $this->isAdmin($user);
//    }
//
//    /**
//     * Determine whether the user can restore the model.
//     */
//    public function restore(User $user, User $model): bool
//    {
//        return $this->isAdmin($user);
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     */
//    public function forceDelete(User $user, User $model): bool
//    {
//        return false; // Force delete is not allowed for users
//    }
}
