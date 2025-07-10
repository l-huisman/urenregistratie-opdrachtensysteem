<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $website
 * @property string $kvk_number
 * @property string $logo
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Client> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PriceAgreement> $priceAgreements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Project> $projects
 *
 */

class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'website',
        'kvk_number',
        'logo',
    ];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }

    public function priceAgreements(): BelongsToMany
    {
        return $this->belongsToMany(PriceAgreement::class, table: 'company_phase_price_agreement')
            ->withPivot(['phase_id'])
            ->withTimestamps();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
