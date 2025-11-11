@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails du Type de Chambre</h1>

            <div class="card">
                <div class="card-header">
                    <h2>{{ $roomType->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Description:</strong> {{ $roomType->description ?? 'Aucune description' }}</p>
                            <p><strong>Prix de base:</strong> {{ number_format($roomType->base_price, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Capacité:</strong> {{ $roomType->capacity }} personne(s)</p>
                            <p><strong>Ventilation:</strong> 
                                @if($roomType->ventilation == 'climatisee')
                                    <span class="badge bg-primary">Climatisée</span>
                                @else
                                    <span class="badge bg-success">Ventilée</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('room-types.edit', $roomType->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('room-types.destroy', $roomType->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de chambre?')">Supprimer</button>
                    </form>
                    <a href="{{ route('room-types.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection