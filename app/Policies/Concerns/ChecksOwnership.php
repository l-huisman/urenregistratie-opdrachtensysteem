<?php

namespace App\Policies\Concerns;

use App\Models\Company;
use App\Models\Project;
use App\Models\User;

trait ChecksOwnership
{
    protected function isProjectOfClient(User $user, Project $project): bool
    {
        return $project->company->clients()->whereKey($user->id)->exists();
    }
}

