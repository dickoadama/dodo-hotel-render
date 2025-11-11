@extends('layouts.app')

@section('title', 'Notifications - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-bell"></i> Notifications</h1>
            
            <!-- Notifications de réservations à venir -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-calendar-check"></i> Réservations à venir (7 prochains jours)</h4>
                </div>
                <div class="card-body">
                    @if($upcomingReservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Chambre</th>
                                        <th>Date d'arrivée</th>
                                        <th>Date de départ</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingReservations as $reservation)
                                    <tr>
                                        <td>
                                            @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                                                {{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}
                                            @else
                                                {{ $reservation->guest->first_name ?? 'Vous' }}
                                            @endif
                                        </td>
                                        <td>{{ $reservation->room->room_number }} ({{ $reservation->room->hotel->name }})</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d/m/Y') }}</td>
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
                    @else
                        <p class="text-muted">Aucune réservation à venir dans les 7 prochains jours.</p>
                    @endif
                </div>
            </div>
            
            <!-- Notifications de factures impayées -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-file-invoice-dollar"></i> Factures à payer (dans les 3 prochains jours)</h4>
                </div>
                <div class="card-body">
                    @if($unpaidInvoices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Client</th>
                                        <th>Date d'échéance</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unpaidInvoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>
                                            @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                                                {{ $invoice->guest->first_name }} {{ $invoice->guest->last_name }}
                                            @else
                                                {{ $invoice->guest->first_name ?? 'Vous' }}
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') }}</td>
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
                    @else
                        <p class="text-muted">Aucune facture impayée dans les 3 prochains jours.</p>
                    @endif
                </div>
            </div>
            
            <!-- Notifications de chambres disponibles -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-bed"></i> Chambres disponibles</h4>
                </div>
                <div class="card-body">
                    @if($availableRooms->count() > 0)
                        <div class="row">
                            @foreach($availableRooms as $room)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $room->room_number }}</h5>
                                        <p class="card-text">
                                            <strong>Hôtel:</strong> {{ $room->hotel->name }}<br>
                                            <strong>Type:</strong> {{ $room->roomType->name ?? 'N/A' }}<br>
                                            <strong>Prix:</strong> {{ number_format($room->price, 0, ',', ' ') }} FCFA/nuit
                                        </p>
                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-info-circle"></i> Détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Aucune chambre disponible actuellement.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection