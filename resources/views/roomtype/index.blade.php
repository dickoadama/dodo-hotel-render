@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des Types de Chambres</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Types de Chambres</h2>
                <a href="{{ route('room-types.create') }}" class="btn btn-primary">Ajouter un Type de Chambre</a>
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
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix de base</th>
                            <th>Capacité</th>
                            <th>Ventilation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roomTypes as $roomType)
                        <tr>
                            <td>{{ $roomType->name }}</td>
                            <td>{{ $roomType->description ?? 'Aucune description' }}</td>
                            <td>{{ number_format($roomType->base_price, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $roomType->capacity }} personne(s)</td>
                            <td>
                                @if($roomType->ventilation == 'climatisee')
                                    <span class="badge bg-primary">Climatisée</span>
                                @else
                                    <span class="badge bg-success">Ventilée</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('room-types.show', $roomType->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('room-types.edit', $roomType->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('room-types.destroy', $roomType->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de chambre?')">Supprimer</button>
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