<?php

namespace App\Models;

use Database\Factories\PriceAgreementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceAgreement extends Model
{
    /** @use HasFactory<PriceAgreementFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'budgeted_hours',
        'hourly_rate',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_phase_price_agreement');
    }

    public function phases(): BelongsToMany
    {
        return $this->belongsToMany(Phase::class, 'company_phase_price_agreement');
    }
}
