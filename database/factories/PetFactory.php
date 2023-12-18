<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'thumbnail' => $this->faker->imageUrl(),
            'descr' => $this->faker->text(),
            'origin' => $this->faker->country(),
            'other_name' => $this->faker->name(),
            'classify' => $this->faker->name(),
            'fur_color' => $this->faker->colorName(),
            'fur_style' => $this->faker->name(),
            'weight' => $this->faker->numberBetween(1,100),
            'longevity' => $this->faker->numberBetween(1,100),
        ];
    }
}
