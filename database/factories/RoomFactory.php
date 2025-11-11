<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'room_number' => $this->faker->unique()->numerify('###'),
            'hotel_id' => \App\Models\Hotel::factory(),
            'room_type_id' => \App\Models\RoomType::factory(),
            'floor' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence,
            'is_available' => $this->faker->boolean(80), // 80% de disponibilité
            'price' => $this->faker->randomNumber(5), // Prix en FCFA
        ];
    }
}