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
        $chambres = [
            '1.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png','9.png','10.png',
            '11.jpg','12.jpg','13.jpg','14.jpg','15.jpeg','16.jpeg','17.jpeg','18.jpeg',
        ];

        return [
            'numero' => fake()->numberBetween(1, 350),
            'libelle' => fake()->sentence(rand(1, 3)),
            'etage' => fake()->numberBetween(1, 6),
            'description' => fake()->paragraph(rand(1, 4)),
            'capacite' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
            /* 'statut' => fake()->randomElement(['Libre', 'Occupé', 'Réservé']) */
            'photo' => 'Chambres/' . $this->faker->randomElement($chambres)
        ];
    }
}
