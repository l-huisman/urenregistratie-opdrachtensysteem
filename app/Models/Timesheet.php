<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    /** @use HasFactory<\Database\Factories\TimesheetFactory> */
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'date',
        'description',
        'worked_hours',
        'is_bugfix',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
