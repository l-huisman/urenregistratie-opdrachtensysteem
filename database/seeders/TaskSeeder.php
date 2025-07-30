<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()->create([
            'name' => 'Taak 1',
            'description' => 'De eerste taak van fase 1.',
            'status' => 'PLANNED',
            'estimated_hours' => 5,
            'actual_hours' => 0,
            'phase_id' => 1,
            'user_id' => 1,
        ]);
    }
}
