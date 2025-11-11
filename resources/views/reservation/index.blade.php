@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des Réservations</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Réservations</h2>
                <a href="{{ route('reservations.create') }}" class="btn btn-primary">Ajouter une Réservation</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Chambre</th>
                            <th>Hôtel</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Statut</th>
                            <th>Prix Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                            <td>{{ $reservation->room->room_number }}</td>
                            <td>{{ $reservation->room->hotel->name }}</td>
                            <td>{{ $reservation->check_in_date->format('d/m/Y') }}</td>
                            <td>{{ $reservation->check_out_date->format('d/m/Y') }}</td>
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
                            <td>
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection