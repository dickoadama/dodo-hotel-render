@extends('layouts.app')

@section('title', 'Tableau de bord - DODO Hotel')

@section('content')
<div class="container">
    <h1 class="mb-4 animate-on-scroll">Tableau de bord</h1>
    
    <!-- Section Hôtels et Chambres -->
    <div class="row">
        <div class="col-12">
            <h3 class="animate-on-scroll"><i class="fas fa-building"></i> Hôtels et Chambres</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-primary h-100 floating">
                <div class="card-header">Hôtels</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $hotelCount }}</h5>
                    <p class="card-text">Nombre total d'hôtels</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-success h-100 floating">
                <div class="card-header">Chambres</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $roomCount }}</h5>
                    <p class="card-text">Nombre total de chambres</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-info h-100 floating">
                <div class="card-header">Chambres Disponibles</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $availableRooms }}</h5>
                    <p class="card-text">Chambres actuellement disponibles</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-warning h-100 floating">
                <div class="card-header">Types de Chambres</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $serviceCount }}</h5>
                    <p class="card-text">Nombre de types de chambres</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section Clients et Réservations -->
    <div class="row">
        <div class="col-12">
            <h3 class="animate-on-scroll"><i class="fas fa-users"></i> Clients et Réservations</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-info h-100 floating">
                <div class="card-header">Clients</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $guestCount }}</h5>
                    <p class="card-text">Nombre total de clients</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-primary h-100 floating">
                <div class="card-header">Réservations</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $reservationCount }}</h5>
                    <p class="card-text">Nombre total de réservations</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4 animate-on-scroll">
            <div class="card h-100">
                <div class="card-header">Détail des réservations</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>En attente:</strong> <span class="badge bg-warning">{{ $pendingReservations }}</span></p>
                            <p><strong>Confirmées:</strong> <span class="badge bg-primary">{{ $confirmedReservations }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Check-in:</strong> <span class="badge bg-success">{{ $checkedInReservations }}</span></p>
                            <p><strong>Check-out:</strong> <span class="badge bg-secondary">{{ $checkedOutReservations }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Annulées:</strong> <span class="badge bg-danger">{{ $cancelledReservations }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section Employés -->
    <div class="row">
        <div class="col-12">
            <h3 class="animate-on-scroll"><i class="fas fa-user-tie"></i> Employés</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4 animate-on-scroll">
            <div class="card text-white bg-dark h-100 floating">
                <div class="card-header">Employés</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $employeeCount }}</h5>
                    <p class="card-text">Nombre total d'employés</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4 animate-on-scroll">
            <div class="card text-white bg-success h-100 floating">
                <div class="card-header">Employés Actifs</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $activeEmployees }}</h5>
                    <p class="card-text">Employés actuellement actifs</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4 animate-on-scroll">
            <div class="card text-white bg-danger h-100 floating">
                <div class="card-header">Employés Inactifs</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $inactiveEmployees }}</h5>
                    <p class="card-text">Employés inactifs</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section Finances -->
    <div class="row">
        <div class="col-12">
            <h3 class="animate-on-scroll"><i class="fas fa-cash-register"></i> Finances</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-primary h-100 floating">
                <div class="card-header">Caisses</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $cashRegisterCount }}</h5>
                    <p class="card-text">Nombre total de caisses</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-info h-100 floating">
                <div class="card-header">Solde Total</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($totalCashBalance, 0, ',', ' ') }} FCFA</h5>
                    <p class="card-text">Solde initial des caisses</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-success h-100 floating">
                <div class="card-header">Entrées du Jour</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($todayIncome, 0, ',', ' ') }} FCFA</h5>
                    <p class="card-text">Total des entrées aujourd'hui</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4 animate-on-scroll">
            <div class="card text-white bg-danger h-100 floating">
                <div class="card-header">Dépenses du Jour</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($todayExpense, 0, ',', ' ') }} FCFA</h5>
                    <p class="card-text">Total des dépenses aujourd'hui</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4 animate-on-scroll">
            <div class="card text-white bg-warning h-100">
                <div class="card-header">Statistiques Mensuelles</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Entrées du mois:</strong> {{ number_format($monthlyIncome, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Dépenses du mois:</strong> {{ number_format($monthlyExpense, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Solde mensuel:</strong> {{ number_format($monthlyIncome - $monthlyExpense, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Total facturé:</strong> {{ number_format($totalInvoiceAmount, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4 animate-on-scroll">
            <div class="card h-100">
                <div class="card-header">Factures</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p><strong>Total:</strong> <span class="badge bg-primary">{{ $invoiceCount }}</span></p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>En attente:</strong> <span class="badge bg-warning">{{ $pendingInvoices }}</span></p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Payées:</strong> <span class="badge bg-success">{{ $paidInvoices }}</span></p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>En retard:</strong> <span class="badge bg-danger">{{ $overdueInvoices }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section Analytique -->
    <div class="row">
        <div class="col-12">
            <h3 class="animate-on-scroll"><i class="fas fa-chart-bar"></i> Analytique</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4 animate-on-scroll">
            <div class="card h-100">
                <div class="card-header">Chambres les plus populaires</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($popularRooms as $room)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $room->room_number }} ({{ $room->hotel->name }})
                                <span class="badge bg-primary rounded-pill">{{ $room->reservations_count }} réservations</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4 animate-on-scroll">
            <div class="card h-100">
                <div class="card-header">Réservations récentes (7 derniers jours)</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Chambre</th>
                                    <th>Statut</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                                    <td>{{ $reservation->room->room_number }}</td>
                                    <td>
                                        @if($reservation->status == 'pending')
                                            <span class="badge bg-warning">En attente</span>
                                        @elseif($reservation->status == 'confirmed')
                                            <span class="badge bg-primary">Confirmée</span>
                                        @elseif($reservation->status == 'checked_in')
                                            <span class="badge bg-success">Check-in</span>
                                        @elseif($reservation->status == 'checked_out')
                                            <span class="badge bg-secondary">Check-out</span>
                                        @elseif($reservation->status == 'cancelled')
                                            <span class="badge bg-danger">Annulée</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section Géolocalisation -->
    <div class="row">
        <div class="col-12">
            <h3 class="animate-on-scroll"><i class="fas fa-map-marker-alt"></i> Géolocalisation des Hôtels</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 mb-4 animate-on-scroll">
            <div class="card">
                <div class="card-header">Situation géographique des hôtels</div>
                <div class="card-body">
                    <p>Les hôtels de notre chaîne sont situés dans des endroits stratégiques pour votre confort. Chaque hôtel dispose de coordonnées GPS précises et d'une description détaillée de sa situation géographique.</p>
                    <div class="row">
                        @foreach(\App\Models\Hotel::all() as $hotel)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hotel->name }}</h5>
                                    @if($hotel->geographical_location)
                                        <p class="card-text"><strong>Situation:</strong> {{ $hotel->geographical_location }}</p>
                                    @endif
                                    @if($hotel->latitude && $hotel->longitude)
                                        <p class="card-text"><strong>Coordonnées GPS:</strong> {{ $hotel->latitude }}, {{ $hotel->longitude }}</p>
                                    @endif
                                    <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-primary btn-sm">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection