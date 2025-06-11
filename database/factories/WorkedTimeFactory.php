<?php

namespace Database\Factories;

use App\Models\Phase;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\WorkedTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkedTime>
 */
class WorkedTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'project_id' => Project::query()->inRandomOrder()->value('id') ?? Project::factory(),
            'phase_id' => Phase::query()->inRandomOrder()->value('id') ?? Phase::factory(),
            'task_id' => Task::query()->inRandomOrder()->value('id') ?? Task::factory(),
            'description' => $this->faker->sentence,
            'worked_hours' => $this->faker->randomElement(range(0.25, 16, 0.25)),
            'billable' => $this->faker->boolean,
            'date' => $this->faker->date(),
        ];
    }
}
