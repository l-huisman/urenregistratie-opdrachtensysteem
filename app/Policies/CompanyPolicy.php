<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Policies\Concerns\ChecksClientCompany;
use App\Policies\Concerns\ChecksRoles;

class CompanyPolicy
{
    use ChecksRoles, ChecksClientCompany;


    public function view(User $user, Company $company): bool
    {
        return $this->isClientOfCompany($user, $company);
    }

    public function create(User $user): bool
    {
        return $user->role->slug === 'client';
    }

    public function update(User $user, Company $company): bool
    {
        return $this->isClientOfCompany($user, $company);
    }

    public function delete(User $user, Company $company): bool
    {
        return $this->isAdministrator($user);
    }

    public function restore(User $user, Company $company): bool
    {
        return $this->isAdministrator($user);
    }
}
