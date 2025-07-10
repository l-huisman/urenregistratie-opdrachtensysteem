<?php

namespace App\Policies\Concerns;

use App\Models\Client;
use App\Models\User;

trait ChecksSelf
{
    protected function isClientSelf(User $user, Client $client): bool
    {
        return $user->id === $client->user_id;
    }
}
