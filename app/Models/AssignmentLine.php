<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentLine extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentLineFactory> */
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'description',
        'planned_hours',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }
}
