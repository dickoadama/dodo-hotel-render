<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = [
            'Chambre Simple',
            'Chambre Double',
            'Chambre Familiale',
            'Suite Junior',
            'Suite Présidentielle',
            'Chambre Deluxe',
            'Chambre Supérieure',
            'Studio',
            'Appartement',
            'Bungalow'
        ];

        return [
            'name' => $this->faker->randomElement($types),
            'description' => $this->faker->sentence,
            'base_price' => $this->faker->randomNumber(5), // Prix en FCFA
            'capacity' => $this->faker->numberBetween(1, 6),
            'ventilation' => $this->faker->randomElement(['climatisee', 'ventilee']),
        ];
    }
}