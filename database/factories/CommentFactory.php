<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'content' => $this->faker->text(),
            'status' => $this->faker->randomElement([0,1,2]),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->domainName()
        ];
    }
}
