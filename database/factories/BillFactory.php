<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_method' => $this->faker->randomElement(['COD','ATM']),
            'total_price' => $this->faker->randomElement([1000,2000,3000,4000,5000,6000,7000,8000,9000,10000]),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'status' => $this->faker->randomElement([0,1,2]),
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)
        ];
    }
}
