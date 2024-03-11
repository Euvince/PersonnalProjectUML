<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeService>
 */
class TypeServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->unique()->randomElement(['Néttoyage', 'Lingerie', 'Restauration', 'Autre']),
            'prix' => $this->faker->numberBetween(444, 1200)
        ];
    }
}
