<?php

namespace App\Policies;

use App\Models\Timesheet;
use App\Models\User;
use App\Policies\Concerns\ChecksRoles;

class TimesheetPolicy extends BasePolicy
{
    use ChecksRoles;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdministrator($user) || $this->isManager($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Timesheet $model
     * @return bool
     */
    public function view(User $user, $model): bool
    {
        return $this->isAdminOrManager($user) || $this->isOwner($user, $model);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // No new timesheets should be created by default
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Timesheet $model
     * @return bool
     */
    public function update(User $user, $model): bool
    {
        return $this->isAdminOrManager($user) || $this->isOwner($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $model): bool
    {
        return false; // No timesheets should be deleted by default
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, $model): bool
    {
        return false; // No timesheets should be restored by default
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, $model): bool
    {
        return false; // No timesheets should be permanently deleted by default
    }

    protected function isOwner(User $user, $model): bool
    {
        return $user->id === $model->user_id;
    }
}
