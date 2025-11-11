<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetHotelApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotel:reset {--force : Force the operation to run when in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Réinitialise l\'application hôtelière (supprime toutes les données et réinitialise la base de données)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('Êtes-vous sûr de vouloir réinitialiser l\'application ? Cela supprimera toutes les données.')) {
            $this->info('Opération annulée.');
            return Command::SUCCESS;
        }

        $this->info('Réinitialisation de l\'application...');

        // Exécution de migrate:fresh pour réinitialiser la base de données
        $this->call('migrate:fresh');

        // Exécution de la commande d'initialisation
        $this->call('hotel:initialize');

        $this->info('Application réinitialisée avec succès !');
        return Command::SUCCESS;
    }
}