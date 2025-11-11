<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\User;

class RoomImageUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_upload_room_image_when_creating_room()
    {
        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Créer un hôtel et un type de chambre pour le test
        $hotel = Hotel::create([
            'name' => 'Hôtel de Test',
            'address' => '123 Rue de Test',
            'city' => 'Ville de Test',
            'country' => 'Pays de Test',
            'phone' => '0123456789',
            'email' => 'hotel@test.com',
            'description' => 'Un hôtel de test',
            'star_rating' => 3
        ]);

        $roomType = RoomType::create([
            'name' => 'Chambre Simple',
            'description' => 'Chambre confortable pour une personne',
            'base_price' => 15000,
            'capacity' => 1,
            'ventilation' => 'climatisee'
        ]);

        // Simuler le stockage
        Storage::fake('public');

        // Créer un fichier image de test
        $image = UploadedFile::fake()->image('room.jpg');

        // Soumettre le formulaire de création de chambre avec une image
        $response = $this->actingAs($admin)->post('/rooms', [
            'room_number' => '101',
            'hotel_id' => $hotel->id,
            'room_type_id' => $roomType->id,
            'floor' => '1er',
            'description' => 'Chambre avec vue sur la mer',
            'is_available' => true,
            'price' => 20000,
            'image' => $image
        ]);

        // Vérifier que la chambre a été créée
        $response->assertRedirect('/rooms');
        $this->assertDatabaseHas('rooms', [
            'room_number' => '101',
            'hotel_id' => $hotel->id,
            'room_type_id' => $roomType->id
        ]);

        // Vérifier que l'image a été stockée
        $room = Room::where('room_number', '101')->first();
        $this->assertNotNull($room->image_path);
        Storage::disk('public')->assertExists($room->image_path);
    }

    /** @test */
    public function room_image_is_displayed_on_room_details_page()
    {
        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Créer une chambre avec une image
        $hotel = Hotel::create([
            'name' => 'Hôtel de Test',
            'address' => '123 Rue de Test',
            'city' => 'Ville de Test',
            'country' => 'Pays de Test',
            'phone' => '0123456789',
            'email' => 'hotel@test.com',
            'description' => 'Un hôtel de test',
            'star_rating' => 3
        ]);

        $roomType = RoomType::create([
            'name' => 'Chambre Simple',
            'description' => 'Chambre confortable pour une personne',
            'base_price' => 15000,
            'capacity' => 1,
            'ventilation' => 'climatisee'
        ]);

        $room = Room::create([
            'room_number' => '102',
            'hotel_id' => $hotel->id,
            'room_type_id' => $roomType->id,
            'floor' => '2ème',
            'description' => 'Chambre avec balcon',
            'is_available' => true,
            'price' => 25000,
            'image_path' => 'rooms/test-image.jpg'
        ]);

        // Vérifier que la page de détail affiche l'image
        $response = $this->actingAs($admin)->get("/rooms/{$room->id}");
        $response->assertStatus(200);
        $response->assertSee('Photo de la chambre 102');
    }
}