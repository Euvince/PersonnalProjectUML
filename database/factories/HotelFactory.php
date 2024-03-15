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
        $hotels = [
            '1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg',
        ];

        return [
            'nom' => $this->faker->company(),
            'longitude' => $this->faker->numberBetween(100, 250),
            'lattitude' => $this->faker->numberBetween(100, 250),
            'adresse_postale' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'directeur' => $this->faker->name(),
            'photo' => 'Hotels/' . $this->faker->randomElement($hotels)
        ];
    }
}
