<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $keyType
 * @property int $company_id
 *
 * @property-read Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Phase> $phases
 * @property-read \Illuminate\Database\Eloquent\Collection<int, WorkedTime> $workedTimes
 */

class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'type',
        'company_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class);
    }

    public function workedTimes(): HasMany
    {
        return $this->hasMany(WorkedTime::class);
    }
}
