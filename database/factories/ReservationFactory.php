<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];
        
        $checkIn = $this->faker->dateTimeBetween('+1 day', '+1 month');
        $checkOut = $this->faker->dateTimeBetween($checkIn->format('Y-m-d H:i:s'), '+2 months');

        return [
            'guest_id' => \App\Models\Guest::factory(),
            'room_id' => \App\Models\Room::factory(),
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'number_of_guests' => $this->faker->numberBetween(1, 4),
            'total_price' => $this->faker->randomNumber(5), // Prix en FCFA
            'status' => $this->faker->randomElement($statuses),
            'special_requests' => $this->faker->optional()->sentence,
        ];
    }
}