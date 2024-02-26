<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChambreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => fake()->numberBetween(1, 350),
            'libelle' => fake()->sentence(rand(1, 3)),
            'etage' => fake()->numberBetween(1, 6),
            'description' => fake()->paragraph(rand(1, 4)),
            'capacite' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
            'statut' => fake()->randomElement(['Libre', 'Occupé', 'Réservé'])
        ];
    }
}
