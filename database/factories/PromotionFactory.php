<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'promotion_name' => $this->faker->name,
            'promotion_type' => $this->faker->randomElement(['fixed', 'percent']),
            'promotion_value' => $this->faker->randomElement([1000,2000,3000,4000,5000,6000,7000,8000,9000,10000]),
            'promotion_status' => $this->faker->randomElement([0,1]),
            'time_start' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
        ];
    }
}
