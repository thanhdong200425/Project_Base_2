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
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['fixed', 'percent']),
            'value' => $this->faker->randomElement([100000,200000,300000,400000,500000,600000,700000,800000,900000,1000000]), 
            'status' => $this->faker->randomElement([0,1])
        ];
    }
}
