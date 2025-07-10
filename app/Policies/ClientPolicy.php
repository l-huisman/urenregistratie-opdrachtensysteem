<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use App\Policies\Concerns\ChecksRoles;
use App\Policies\Concerns\ChecksSelf;

class ClientPolicy
{
    use ChecksRoles, ChecksSelf;


    public function viewAny(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    public function view(User $user, Client $client): bool
    {
        return $this->isAdministrator($user) || $this->isClientSelf($user, $client);
    }

    public function create(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    public function update(User $user, Client $client): bool
    {
        return $this->isAdministrator($user) || $this->isClientSelf($user, $client);
    }

    public function delete(User $user, Client $client): bool
    {
        return $this->isAdministrator($user);
    }

    public function restore(User $user, Client $client): bool
    {
        return $this->isAdministrator($user);
    }

    public function forceDelete(User $user, Client $client): bool
    {
        return false; // Not allowed by default
    }
}
