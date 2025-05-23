<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactPerson extends Model
{
    /** @use HasFactory<\Database\Factories\ContactPersonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'company_id',
        'email',
        'phone',
        'address',
    ];

    protected $table = 'contact_persons'; // Otherwise it will be 'contact_people' thanks laravel...

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
