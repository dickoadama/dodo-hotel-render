<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotel;

class UpdateHotelGeolocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:update-geolocation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mettre à jour les hôtels existants avec des données de géolocalisation de démonstration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Mise à jour des hôtels avec des données de géolocalisation...');

        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            // Exemple de données de géolocalisation pour la démonstration
            // Vous pouvez remplacer ces valeurs par des coordonnées réelles
            $hotel->update([
                'latitude' => rand(48000000, 49000000) / 1000000, // Latitude entre 48 et 49
                'longitude' => rand(2000000, 3000000) / 1000000,  // Longitude entre 2 et 3
                'geographical_location' => 'Situé dans le centre-ville, à proximité des attractions touristiques et des commerces.'
            ]);

            $this->info("Hôtel '{$hotel->name}' mis à jour avec succès.");
        }

        $this->info('Tous les hôtels ont été mis à jour avec des données de géolocalisation!');
        return Command::SUCCESS;
    }
}