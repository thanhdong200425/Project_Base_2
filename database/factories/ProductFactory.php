<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->name(),
            'price' => $this->faker->randomElement([100, 200, 300, 400, 500, 600, 700, 800, 900, 1000]),
            'quantity' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'thumpnail2' => $this->faker->imageUrl($width = 640, $height = 480),
            'dimensions' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'color' => $this->faker->randomElement(['red', 'blue', 'green', 'yellow', 'black', 'white', 'pink', 'purple', 'orange', 'gray']),
            'evaluate_star' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'evaluate_quantity' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'description' => $this->faker->text($maxNbChars = 200),
            'product_status' => $this->faker->randomElement([0, 1]),
            'ingredient' => $this->faker->text($maxNbChars = 200),
            'origin' => $this->faker->country(),
        ];
    }
}
