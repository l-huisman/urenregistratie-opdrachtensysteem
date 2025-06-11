<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\WorkedTimeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property int $phase_id
 * @property int|null $task_id
 * @property string $description
 * @property float $worked_hours
 * @property bool $billable
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class WorkedTime extends Model
{
    /** @use HasFactory<WorkedTimeFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $table = 'worked_time';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
