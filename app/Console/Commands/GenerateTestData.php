<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\Employee;
use App\Models\CashRegister;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class GenerateTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:generate-test-data {--count=10 : Number of records to generate for each entity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère des données de test pour l\'application hôtelière';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->option('count');
        
        $this->info("Génération de {$count} enregistrements de test pour chaque entité...");

        // Création d'hôtels de test
        $this->info('Création des hôtels...');
        $hotels = Hotel::factory()->count($count)->create();

        // Création de types de chambres
        $this->info('Création des types de chambres...');
        $roomTypes = RoomType::factory()->count(5)->create();

        // Création de chambres
        $this->info('Création des chambres...');
        foreach ($hotels as $hotel) {
            foreach ($roomTypes as $roomType) {
                for ($i = 1; $i <= 5; $i++) {
                    Room::factory()->create([
                        'hotel_id' => $hotel->id,
                        'room_type_id' => $roomType->id,
                        'room_number' => strtoupper(substr($roomType->name, 0, 1)) . rand(100, 999),
                    ]);
                }
            }
        }

        // Création de clients
        $this->info('Création des clients...');
        $guests = Guest::factory()->count($count * 2)->create();

        // Création de services
        $this->info('Création des services...');
        $services = Service::factory()->count(10)->create();

        // Création de réservations
        $this->info('Création des réservations...');
        foreach ($guests as $guest) {
            // Chaque client peut avoir 0 à 2 réservations
            $reservationCount = rand(0, 2);
            for ($i = 0; $i < $reservationCount; $i++) {
                $room = Room::inRandomOrder()->first();
                if ($room) {
                    $checkIn = now()->addDays(rand(1, 30));
                    $checkOut = $checkIn->clone()->addDays(rand(1, 7));
                    
                    Reservation::factory()->create([
                        'guest_id' => $guest->id,
                        'room_id' => $room->id,
                        'check_in_date' => $checkIn,
                        'check_out_date' => $checkOut,
                        'total_price' => $room->price * $checkIn->diffInDays($checkOut),
                    ]);
                }
            }
        }

        // Création d'employés
        $this->info('Création des employés...');
        $employees = Employee::factory()->count($count)->create();

        // Création de caisses
        $this->info('Création des caisses...');
        $cashRegisters = CashRegister::factory()->count(3)->create();

        // Création de transactions
        $this->info('Création des transactions...');
        foreach ($cashRegisters as $cashRegister) {
            // Créer 20 transactions aléatoires par caisse
            Transaction::factory()->count(20)->create([
                'cash_register_id' => $cashRegister->id
            ]);
        }

        $this->info('Génération des données de test terminée avec succès!');
        return Command::SUCCESS;
    }
}