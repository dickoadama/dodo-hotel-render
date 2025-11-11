@extends('layouts.app')

@section('title', 'Résultats de recherche - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-search-results"></i> Résultats de recherche</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Recherche : "{{ $query }}"</h5>
                    <p>Type : 
                        @switch($type)
                            @case('hotels') Hôtels @break
                            @case('rooms') Chambres @break
                            @case('guests') Clients @break
                            @case('reservations') Réservations @break
                            @case('employees') Employés @break
                            @case('invoices') Factures @break
                            @default Tout @break
                        @endswitch
                    </p>
                    <a href="{{ route('search') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Nouvelle recherche
                    </a>
                </div>
            </div>
            
            @if($type === 'all')
                <!-- Résultats pour tous les types -->
                @if($results['hotels']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-building"></i> Hôtels ({{ $results['hotels']->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Adresse</th>
                                        <th>Ville</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['hotels'] as $hotel)
                                    <tr>
                                        <td>{{ $hotel->name }}</td>
                                        <td>{{ $hotel->address }}</td>
                                        <td>{{ $hotel->city }}</td>
                                        <td>
                                            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($results['rooms']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-bed"></i> Chambres ({{ $results['rooms']->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Hôtel</th>
                                        <th>Type</th>
                                        <th>Étage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['rooms'] as $room)
                                    <tr>
                                        <td>{{ $room->room_number }}</td>
                                        <td>{{ $room->hotel->name }}</td>
                                        <td>{{ $room->roomType->name ?? 'N/A' }}</td>
                                        <td>{{ $room->floor }}</td>
                                        <td>
                                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($results['guests']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-users"></i> Clients ({{ $results['guests']->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['guests'] as $guest)
                                    <tr>
                                        <td>{{ $guest->first_name }} {{ $guest->last_name }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td>
                                            <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($results['reservations']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-calendar-check"></i> Réservations ({{ $results['reservations']->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Chambre</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['reservations'] as $reservation)
                                    <tr>
                                        <td>{{ $reservation->id }}</td>
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
                                        <td>
                                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($results['employees']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-user-tie"></i> Employés ({{ $results['employees']->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Poste</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['employees'] as $employee)
                                    <tr>
                                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->position }}</td>
                                        <td>
                                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($results['invoices']->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-file-invoice"></i> Factures ({{ $results['invoices']->count() }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Client</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['invoices'] as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->guest->first_name }} {{ $invoice->guest->last_name }}</td>
                                        <td>{{ number_format($invoice->total_amount, 0, ',', ' ') }} FCFA</td>
                                        <td>
                                            @if($invoice->status == 'pending')
                                                <span class="badge bg-warning">En attente</span>
                                            @elseif($invoice->status == 'paid')
                                                <span class="badge bg-success">Payée</span>
                                            @elseif($invoice->status == 'overdue')
                                                <span class="badge bg-danger">En retard</span>
                                            @elseif($invoice->status == 'cancelled')
                                                <span class="badge bg-secondary">Annulée</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($results['hotels']->count() == 0 && $results['rooms']->count() == 0 && $results['guests']->count() == 0 && 
                   $results['reservations']->count() == 0 && $results['employees']->count() == 0 && $results['invoices']->count() == 0)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Aucun résultat trouvé pour votre recherche.
                    </div>
                @endif
            @else
                <!-- Résultats pour un type spécifique -->
                @if(is_array($results) && count($results) > 0)
                    @switch($type)
                        @case('hotels')
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="fas fa-building"></i> Résultats pour les Hôtels</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Adresse</th>
                                                    <th>Ville</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $hotel)
                                                <tr>
                                                    <td>{{ $hotel->name }}</td>
                                                    <td>{{ $hotel->address }}</td>
                                                    <td>{{ $hotel->city }}</td>
                                                    <td>
                                                        <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @break
                            
                        @case('rooms')
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="fas fa-bed"></i> Résultats pour les Chambres</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Numéro</th>
                                                    <th>Hôtel</th>
                                                    <th>Type</th>
                                                    <th>Étage</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $room)
                                                <tr>
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->hotel->name }}</td>
                                                    <td>{{ $room->roomType->name ?? 'N/A' }}</td>
                                                    <td>{{ $room->floor }}</td>
                                                    <td>
                                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @break
                            
                        @case('guests')
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="fas fa-users"></i> Résultats pour les Clients</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                    <th>Téléphone</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $guest)
                                                <tr>
                                                    <td>{{ $guest->first_name }} {{ $guest->last_name }}</td>
                                                    <td>{{ $guest->email }}</td>
                                                    <td>{{ $guest->phone }}</td>
                                                    <td>
                                                        <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @break
                            
                        @case('reservations')
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="fas fa-calendar-check"></i> Résultats pour les Réservations</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Client</th>
                                                    <th>Chambre</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->id }}</td>
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
                                                    <td>
                                                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @break
                            
                        @case('employees')
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="fas fa-user-tie"></i> Résultats pour les Employés</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                    <th>Poste</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $employee)
                                                <tr>
                                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>{{ $employee->position }}</td>
                                                    <td>
                                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @break
                            
                        @case('invoices')
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="fas fa-file-invoice"></i> Résultats pour les Factures</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Numéro</th>
                                                    <th>Client</th>
                                                    <th>Montant</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($results as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->invoice_number }}</td>
                                                    <td>{{ $invoice->guest->first_name }} {{ $invoice->guest->last_name }}</td>
                                                    <td>{{ number_format($invoice->total_amount, 0, ',', ' ') }} FCFA</td>
                                                    <td>
                                                        @if($invoice->status == 'pending')
                                                            <span class="badge bg-warning">En attente</span>
                                                        @elseif($invoice->status == 'paid')
                                                            <span class="badge bg-success">Payée</span>
                                                        @elseif($invoice->status == 'overdue')
                                                            <span class="badge bg-danger">En retard</span>
                                                        @elseif($invoice->status == 'cancelled')
                                                            <span class="badge bg-secondary">Annulée</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @break
                    @endswitch
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Aucun résultat trouvé pour votre recherche.
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection