<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assignment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['fixed', 'bundle']);
        return [
            'company_id' => Company::factory(),
            'name' => $this->faker->bs(),
            'type' => $type,
            'max_hours' => ($type === 'fixed' || $type === 'bundle') ? $this->faker->numberBetween(10, 200) : null,
        ];
    }
}
