@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier une Réservation</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="guest_id" class="form-label">Client</label>
                            <select class="form-control" id="guest_id" name="guest_id" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach($guests as $guest)
                                    <option value="{{ $guest->id }}" {{ old('guest_id', $reservation->guest_id) == $guest->id ? 'selected' : '' }}>
                                        {{ $guest->first_name }} {{ $guest->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Chambre</label>
                            <select class="form-control" id="room_id" name="room_id" required>
                                <option value="">Sélectionnez une chambre</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id', $reservation->room_id) == $room->id ? 'selected' : '' }}>
                                        {{ $room->room_number }} - {{ $room->roomType->name }} ({{ number_format($room->price, 0, ',', ' ') }} FCFA)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="check_in_date" class="form-label">Date d'arrivée</label>
                            <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="{{ old('check_in_date', $reservation->check_in_date->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="check_out_date" class="form-label">Date de départ</label>
                            <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="{{ old('check_out_date', $reservation->check_out_date->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="number_of_guests" class="form-label">Nombre de personnes</label>
                            <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" value="{{ old('number_of_guests', $reservation->number_of_guests) }}" min="1" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Prix total (FCFA)</label>
                            <input type="number" class="form-control" id="total_price" name="total_price" value="{{ old('total_price', $reservation->total_price) }}" step="1" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                        <option value="checked_in" {{ old('status', $reservation->status) == 'checked_in' ? 'selected' : '' }}>Check-in</option>
                        <option value="checked_out" {{ old('status', $reservation->status) == 'checked_out' ? 'selected' : '' }}>Check-out</option>
                        <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="special_requests" class="form-label">Demandes spéciales</label>
                    <textarea class="form-control" id="special_requests" name="special_requests" rows="3">{{ old('special_requests', $reservation->special_requests) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour la réservation</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection