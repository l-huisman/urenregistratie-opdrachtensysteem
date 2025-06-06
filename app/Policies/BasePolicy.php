<?php

namespace App\Policies;

use App\Policies\Concerns\ChecksOwner;
use App\Policies\Concerns\ChecksRoles;

class BasePolicy
{
    use ChecksRoles;
    use ChecksOwner;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
