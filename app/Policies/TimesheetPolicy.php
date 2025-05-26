<?php

namespace App\Policies;

use App\Models\Timesheet;
use App\Models\User;

class TimesheetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return match ($user->role->slug) {
            'manager', 'administrator' => true,
            default => false,
        };
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Timesheet $timesheet): bool
    {
        return match ($user->role->slug) {
            'gebruiker' => $this->isOwner($user, $timesheet),
            'manager', 'administrator' => true,
            default => false,
        };
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // No new timesheets should be created by default
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Timesheet $timesheet): bool
    {
        return match ($user->role->slug) {
            'gebruiker' => $this->isOwner($user, $timesheet),
            'manager', 'administrator' => true,
            default => false,
        };
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Timesheet $timesheet): bool
    {
        return false; // No timesheets should be deleted by default
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Timesheet $timesheet): bool
    {
        return false; // No timesheets should be restored by default
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Timesheet $timesheet): bool
    {
        return false; // No timesheets should be permanently deleted by default
    }

    private function isOwner(User $user, Timesheet $timesheet)
    {
        return $user->id === $timesheet->user_id;
    }
}
