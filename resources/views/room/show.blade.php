@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails de la Chambre</h1>

            <div class="card">
                <div class="card-header">
                    <h2>Chambre {{ $room->room_number }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($room->image_path)
                                <img src="{{ asset('storage/' . $room->image_path) }}" alt="Photo de la chambre {{ $room->room_number }}" class="img-fluid mb-3">
                            @else
                                <div class="bg-light text-center p-5 mb-3">
                                    <p class="text-muted">Aucune photo disponible</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Hôtel:</strong> {{ $room->hotel->name }}</p>
                            <p><strong>Type de chambre:</strong> {{ $room->roomType->name }}</p>
                            <p><strong>Étage:</strong> {{ $room->floor }}</p>
                            <p><strong>Prix:</strong> {{ number_format($room->price, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Disponible:</strong> {{ $room->is_available ? 'Oui' : 'Non' }}</p>
                            <p><strong>Description:</strong> {{ $room->description ?? 'Aucune description' }}</p>
                            <p><strong>Ventilation:</strong> 
                                @if($room->roomType->ventilation == 'climatisee')
                                    <span class="badge bg-primary">Climatisée</span>
                                @else
                                    <span class="badge bg-success">Ventilée</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette chambre?')">Supprimer</button>
                    </form>
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection