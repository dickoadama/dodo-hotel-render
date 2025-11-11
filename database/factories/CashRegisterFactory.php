<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CashRegister>
 */
class CashRegisterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Caisse principale', 'Caisse restaurant', 'Caisse bar', 'Caisse réception']),
            'description' => $this->faker->sentence,
            'balance' => $this->faker->randomNumber(6), // Solde initial en FCFA
            'is_active' => $this->faker->boolean(90), // 90% de caisses actives
        ];
    }
}