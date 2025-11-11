<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $positions = [
            'Réceptionniste',
            'Gouvernante',
            'Chef de cuisine',
            'Serveur',
            'Concierge',
            'Directeur d\'hôtel',
            'Assistant(e) de direction',
            'Technicien informatique',
            'Comptable',
            'Responsable des ressources humaines'
        ];

        $departments = [
            'Réception',
            'Ménage',
            'Restaurant',
            'Sécurité',
            'Direction',
            'Informatique',
            'Comptabilité',
            'Ressources humaines'
        ];

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'position' => $this->faker->randomElement($positions),
            'department' => $this->faker->randomElement($departments),
            'salary' => $this->faker->randomNumber(5), // Salaire en FCFA
            'hire_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'is_active' => $this->faker->boolean(90), // 90% d'employés actifs
            'address' => $this->faker->address,
            'date_of_birth' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'national_id' => $this->faker->unique()->numerify('ID####')
        ];
    }
}