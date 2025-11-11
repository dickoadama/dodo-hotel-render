@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails de l'Hôtel</h1>

            <div class="card">
                <div class="card-header">
                    <h2>{{ $hotel->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Adresse:</strong> {{ $hotel->address }}</p>
                            <p><strong>Ville:</strong> {{ $hotel->city }}</p>
                            <p><strong>Pays:</strong> {{ $hotel->country }}</p>
                            <p><strong>Téléphone:</strong> {{ $hotel->phone }}</p>
                            <p><strong>Email:</strong> {{ $hotel->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nombre d'étoiles:</strong> {{ $hotel->star_rating }}</p>
                            <p><strong>Description:</strong> {{ $hotel->description ?? 'Aucune description' }}</p>
                            @if($hotel->geographical_location)
                                <p><strong>Situation géographique:</strong> {{ $hotel->geographical_location }}</p>
                            @endif
                            @if($hotel->latitude && $hotel->longitude)
                                <p><strong>Coordonnées GPS:</strong> {{ $hotel->latitude }}, {{ $hotel->longitude }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet hôtel?')">Supprimer</button>
                    </form>
                    <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection