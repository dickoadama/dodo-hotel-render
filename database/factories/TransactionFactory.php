<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CashRegister;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['income', 'expense'];
        $categories = [
            'income' => ['Réservation', 'Restaurant', 'Bar', 'Service', 'Autres revenus'],
            'expense' => ['Salaire', 'Fournitures', 'Maintenance', 'Énergie', 'Autres dépenses']
        ];
        
        $type = $this->faker->randomElement($types);
        $category = $this->faker->randomElement($categories[$type]);

        return [
            'cash_register_id' => CashRegister::factory(),
            'type' => $type,
            'category' => $category,
            'description' => $this->faker->sentence,
            'amount' => $this->faker->randomNumber(5), // Montant en FCFA
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'reference' => $this->faker->optional()->numerify('REF####'),
            'notes' => $this->faker->optional()->sentence,
        ];
    }
}