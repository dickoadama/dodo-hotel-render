<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\Room;

class InitializeHotelApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialise l\'application avec des données de démonstration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Initialisation de l\'application DODO Hotel...');

        // Création d'un hôtel de démonstration
        $hotel = Hotel::create([
            'name' => 'Hôtel DODO Démo',
            'address' => '123 Rue de la Paix',
            'city' => 'Paris',
            'country' => 'France',
            'phone' => '+33 1 23 45 67 89',
            'email' => 'contact@hotel-dodo-demo.fr',
            'description' => 'Hôtel de démonstration pour l\'application DODO',
            'star_rating' => 4
        ]);

        $this->info('Hôtel créé avec succès.');

        // Création de types de chambres climatisées
        $simpleRoomType = RoomType::create([
            'name' => 'Chambre Simple Climatisée',
            'description' => 'Chambre confortable pour une personne avec climatisation',
            'base_price' => 15000,
            'capacity' => 1,
            'ventilation' => 'climatisee'
        ]);

        $doubleRoomType = RoomType::create([
            'name' => 'Chambre Double Climatisée',
            'description' => 'Chambre spacieuse pour deux personnes avec climatisation',
            'base_price' => 25000,
            'capacity' => 2,
            'ventilation' => 'climatisee'
        ]);

        $suiteRoomType = RoomType::create([
            'name' => 'Suite Climatisée',
            'description' => 'Suite luxueuse avec salon séparé et climatisation',
            'base_price' => 50000,
            'capacity' => 4,
            'ventilation' => 'climatisee'
        ]);

        // Création de types de chambres ventilées
        $simpleRoomTypeVentilee = RoomType::create([
            'name' => 'Chambre Simple Ventilée',
            'description' => 'Chambre confortable pour une personne avec ventilation naturelle',
            'base_price' => 10000,
            'capacity' => 1,
            'ventilation' => 'ventilee'
        ]);

        $doubleRoomTypeVentilee = RoomType::create([
            'name' => 'Chambre Double Ventilée',
            'description' => 'Chambre spacieuse pour deux personnes avec ventilation naturelle',
            'base_price' => 18000,
            'capacity' => 2,
            'ventilation' => 'ventilee'
        ]);

        $this->info('Types de chambres créés avec succès.');

        // Création de chambres climatisées
        for ($i = 1; $i <= 5; $i++) {
            Room::create([
                'room_number' => '10' . $i,
                'hotel_id' => $hotel->id,
                'room_type_id' => $simpleRoomType->id,
                'floor' => '1',
                'description' => 'Chambre simple climatisée avec vue sur cour',
                'is_available' => true,
                'price' => 15000
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            Room::create([
                'room_number' => '20' . $i,
                'hotel_id' => $hotel->id,
                'room_type_id' => $doubleRoomType->id,
                'floor' => '2',
                'description' => 'Chambre double climatisée avec balcon',
                'is_available' => true,
                'price' => 25000
            ]);
        }

        for ($i = 1; $i <= 2; $i++) {
            Room::create([
                'room_number' => '30' . $i,
                'hotel_id' => $hotel->id,
                'room_type_id' => $suiteRoomType->id,
                'floor' => '3',
                'description' => 'Suite climatisée avec vue panoramique',
                'is_available' => true,
                'price' => 50000
            ]);
        }

        // Création de chambres ventilées
        for ($i = 1; $i <= 3; $i++) {
            Room::create([
                'room_number' => '40' . $i,
                'hotel_id' => $hotel->id,
                'room_type_id' => $simpleRoomTypeVentilee->id,
                'floor' => '4',
                'description' => 'Chambre simple ventilée avec vue sur jardin',
                'is_available' => true,
                'price' => 10000
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            Room::create([
                'room_number' => '50' . $i,
                'hotel_id' => $hotel->id,
                'room_type_id' => $doubleRoomTypeVentilee->id,
                'floor' => '5',
                'description' => 'Chambre double ventilée avec terrasse',
                'is_available' => true,
                'price' => 18000
            ]);
        }

        $this->info('Chambres créées avec succès.');
        $this->info('Initialisation terminée avec succès!');

        return Command::SUCCESS;
    }
}