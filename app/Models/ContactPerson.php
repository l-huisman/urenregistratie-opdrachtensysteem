<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPerson extends Model
{
    /** @use HasFactory<\Database\Factories\ContactPersonFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    protected $table = 'contact_persons'; // Otherwise it will be 'contact_people' thanks laravel...


    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_contact_person');
    }
}
