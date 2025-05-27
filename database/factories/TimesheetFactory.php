<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Timesheet>
 */
class TimesheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timesheet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assignment_id' => Assignment::factory(),
            'user_id' => User::factory(),
            'description' => $this->faker->paragraph(),
            'hours' => $this->faker->randomFloat(2, 0.5, 8),
            'is_bugfix' => $this->faker->boolean(10),
        ];
    }
}
