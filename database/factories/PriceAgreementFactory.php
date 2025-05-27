<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PriceAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PriceAgreement>
 */
class PriceAgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PriceAgreement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $endDate = $this->faker->optional(0.7, null)->dateTimeBetween($startDate, '+1 year'); // 70% chance of having an end date

        return [
            'company_id' => Company::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate?->format('Y-m-d'),
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'rate' => $this->faker->randomFloat(2, 50, 200),
        ];
    }
}
