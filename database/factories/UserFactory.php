<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => $this->faker->jobTitle,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(10)),
            'remember_token' => Str::random(10),
        ];
    }
    public function specificUser(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'Vardenis Pavardenis',
            'position' => 'Servizo administratorius',
            'email' => 'test@gmail.com',
            'password' => bcrypt('testas'),
        ]);
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
