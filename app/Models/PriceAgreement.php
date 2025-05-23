<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;
class PriceAgreement extends Model
{
    /** @use HasFactory<\Database\Factories\PriceAgreementFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'start_date',
        'end_date',
        'price',
        'rate',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
