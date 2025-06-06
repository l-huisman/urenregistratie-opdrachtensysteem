<?php

namespace App\Policies\Concerns;

use App\Models\Company;
use App\Models\User;

trait ChecksClientCompany
{
    protected function isClientOfCompany(User $user, Company $company): bool
    {
        return $company->clients()->where('user_id', $user->id)->exists();
    }
}

