<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'longitude' => $this->faker->numberBetween(100, 250),
            'lattitude' => $this->faker->numberBetween(100, 250),
            'adresse_postale' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'directeur' => $this->faker->name(),
        ];
    }
}
