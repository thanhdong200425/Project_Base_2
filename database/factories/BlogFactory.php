<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'content' => $this->faker->text(),
            'view_count' => $this->faker->numberBetween(1,100),
            'comment_count' => $this->faker->numberBetween(1,100),
            'thumbnail' => $this->faker->imageUrl(),
            'descr' => $this->faker->text(),
            'author' => $this->faker->name()
        ];
    }
}
