<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffPosition>
 */
class Expert_TeamFactory extends Factory
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
            'gender' => $this->faker->randomElement([0,1]),
            'dob' => $this->faker->date(),
            'phone' => $this->faker->randomElement([0,1]),
            'email' => $this->faker->unique()->safeEmail(),
            'avatar' => $this->faker->imageUrl(),
            'description' => $this->faker->text(),
            'pinterest' => $this->faker->url(),
            'facebook' => $this->faker->url(),
            'twitter' => $this->faker->url(),
            'tiktok' => $this->faker->url(),
        ];
    }
}
