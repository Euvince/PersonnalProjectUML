<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DepartementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /* 'nom' => $this->faker->unique()->randomElement([
                'ATACORA', 'DONGA', 'BORGOU', 'ALIBORI',
                'ZOU', 'OUÉMÉ', 'PLATEAU', 'MONO', 'COUFFO'
            ]), */
            'nom' => $this->faker->company(),
            'longitude' => $this->faker->numberBetween(100, 250),
            'lattitude' => $this->faker->numberBetween(100, 250),
        ];
    }
}
