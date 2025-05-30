<?php

namespace App\Models;

use Database\Factories\PhaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phase extends Model
{
    /** @use HasFactory<PhaseFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'name',
        'description',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function priceAgreements(): HasMany
    {
        return $this->hasMany(PriceAgreement::class);
    }
}
