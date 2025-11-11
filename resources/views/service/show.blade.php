@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails du Service</h1>

            <div class="card">
                <div class="card-header">
                    <h2>{{ $service->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Description:</strong> {{ $service->description ?? 'Aucune description' }}</p>
                            <p><strong>Prix:</strong> {{ number_format($service->price, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Disponible:</strong> {{ $service->is_available ? 'Oui' : 'Non' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service?')">Supprimer</button>
                    </form>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection