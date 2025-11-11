<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Hotel;
use App\Models\User;

class HotelGeolocationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function hotel_geographical_location_is_displayed_on_invoice()
    {
        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Créer un hôtel avec des données de géolocalisation
        $hotel = Hotel::create([
            'name' => 'Hôtel de Test',
            'address' => '123 Rue de Test',
            'city' => 'Ville de Test',
            'country' => 'Pays de Test',
            'phone' => '0123456789',
            'email' => 'hotel@test.com',
            'description' => 'Un hôtel de test',
            'star_rating' => 3,
            'latitude' => 48.8566,
            'longitude' => 2.3522,
            'geographical_location' => 'Situé au cœur de la ville, à proximité des attractions touristiques.'
        ]);

        // Vérifier que la page de l'hôtel affiche la situation géographique
        $response = $this->actingAs($admin)->get("/hotels/{$hotel->id}");
        $response->assertStatus(200);
        $response->assertSee('Situé au cœur de la ville, à proximité des attractions touristiques.');
        
        // Vérifier que les coordonnées GPS sont affichées
        $response->assertSee('48.8566');
        $response->assertSee('2.3522');
    }
}