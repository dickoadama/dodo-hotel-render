@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails de la Réservation</h1>

            <div class="card">
                <div class="card-header">
                    <h2>Réservation #{{ $reservation->id }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Informations du Client</h3>
                            <p><strong>Nom:</strong> {{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</p>
                            <p><strong>Email:</strong> {{ $reservation->guest->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $reservation->guest->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3>Informations de la Réservation</h3>
                            <p><strong>Chambre:</strong> {{ $reservation->room->room_number }} ({{ $reservation->room->roomType->name }})</p>
                            <p><strong>Hôtel:</strong> {{ $reservation->room->hotel->name }}</p>
                            <p><strong>Date d'arrivée:</strong> {{ $reservation->check_in_date->format('d/m/Y') }}</p>
                            <p><strong>Date de départ:</strong> {{ $reservation->check_out_date->format('d/m/Y') }}</p>
                            <p><strong>Nombre de personnes:</strong> {{ $reservation->number_of_guests }}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p><strong>Prix total:</strong> {{ number_format($reservation->total_price, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Statut:</strong> 
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
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ventilation de la chambre:</strong> 
                                @if($reservation->room->roomType->ventilation == 'climatisee')
                                    <span class="badge bg-primary">Climatisée</span>
                                @else
                                    <span class="badge bg-success">Ventilée</span>
                                @endif
                            </p>
                            <p><strong>Demandes spéciales:</strong> {{ $reservation->special_requests ?? 'Aucune' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Supprimer</button>
                    </form>
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection