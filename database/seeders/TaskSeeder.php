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
            'phase_id' => 1,
            'name' => 'Taak 1',
            'description' => 'De eerste taak van fase 1.',
            'estimated_hours' => 5,
        ]);
    }
}
