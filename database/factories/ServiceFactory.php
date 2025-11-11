<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $services = [
            'Petit déjeuner',
            'Déjeuner',
            'Dîner',
            'Service de chambre 24h/24',
            'Wi-Fi gratuit',
            'Parking',
            'Spa et massage',
            'Piscine',
            'Salle de sport',
            'Conciergerie',
            'Location de voiture',
            'Navette aéroport',
            'Blanchisserie',
            'Baby-sitting',
            'Location de vélos'
        ];

        return [
            'name' => $this->faker->randomElement($services),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomNumber(4), // Prix en FCFA
            'is_available' => $this->faker->boolean(90), // 90% de disponibilité
        ];
    }
}