<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string name
 * @property string slug
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 */

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function users(): HasMany
    {
        return $this->HasMany(User::class, 'role_user');
    }
}
