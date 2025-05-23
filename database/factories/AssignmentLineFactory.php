<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\AssignmentLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignmentLine>
 */
class AssignmentLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssignmentLine::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assignment_id' => Assignment::factory(),
            'description' => $this->faker->sentence(),
            'hours' => $this->faker->randomFloat(2, 1, 8),
        ];
    }
}
