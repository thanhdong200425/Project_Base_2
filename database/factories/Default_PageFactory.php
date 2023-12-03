<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Default_Page;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Default_Page>
 */
class Default_PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'slug' => $this->faker->unique()->slug(),
            'content' => $this->faker->text()
        ];
    }
}
