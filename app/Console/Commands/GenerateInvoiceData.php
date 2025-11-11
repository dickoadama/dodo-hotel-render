<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Reservation;
use App\Models\Guest;

class GenerateInvoiceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:generate-invoice-data {--count=10 : Number of invoices to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère des données de test pour les factures';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->option('count');
        
        $this->info("Génération de {$count} factures de test...");

        // Récupérer toutes les réservations
        $reservations = Reservation::with('guest', 'room')->get();
        
        if ($reservations->isEmpty()) {
            $this->error('Aucune réservation trouvée. Veuillez d\'abord générer des données de test.');
            return Command::FAILURE;
        }

        for ($i = 0; $i < $count; $i++) {
            // Sélectionner une réservation aléatoire
            $reservation = $reservations->random();
            
            // Générer un numéro de facture unique
            $invoiceNumber = 'INV-' . date('Y') . '-' . str_pad(Invoice::count() + $i + 1, 5, '0', STR_PAD_LEFT);
            
            // Créer la facture
            $invoice = Invoice::create([
                'reservation_id' => $reservation->id,
                'guest_id' => $reservation->guest_id,
                'invoice_number' => $invoiceNumber,
                'invoice_date' => now()->subDays(rand(1, 30)),
                'due_date' => now()->subDays(rand(1, 30))->addDays(30),
                'subtotal' => $reservation->total_price,
                'tax_amount' => $reservation->total_price * 0.1, // 10% de TVA
                'total_amount' => $reservation->total_price * 1.1,
                'status' => ['pending', 'paid', 'overdue', 'cancelled'][rand(0, 3)],
                'notes' => 'Facture générée automatiquement pour démonstration'
            ]);
            
            // Créer des articles de facture
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => 'Séjour en chambre ' . $reservation->room->room_number,
                'quantity' => $reservation->check_in_date->diffInDays($reservation->check_out_date),
                'unit_price' => $reservation->room->price,
                'total_price' => $reservation->total_price
            ]);
            
            // Ajouter des services supplémentaires aléatoires
            if (rand(0, 1)) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'description' => 'Service de petit déjeuner',
                    'quantity' => rand(1, 5),
                    'unit_price' => rand(5000, 15000),
                    'total_price' => rand(5000, 15000) * rand(1, 5)
                ]);
            }
            
            if (rand(0, 1)) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'description' => 'Service de nettoyage',
                    'quantity' => 1,
                    'unit_price' => rand(10000, 30000),
                    'total_price' => rand(10000, 30000)
                ]);
            }
        }

        $this->info("{$count} factures générées avec succès!");
        return Command::SUCCESS;
    }
}