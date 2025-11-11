@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails du Client</h1>

            <div class="card">
                <div class="card-header">
                    <h2>{{ $guest->first_name }} {{ $guest->last_name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $guest->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $guest->phone }}</p>
                            <p><strong>Adresse:</strong> {{ $guest->address ?? 'Non spécifiée' }}</p>
                            <p><strong>Ville:</strong> {{ $guest->city ?? 'Non spécifiée' }}</p>
                            <p><strong>Pays:</strong> {{ $guest->country ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date de naissance:</strong> {{ $guest->date_of_birth ?? 'Non spécifiée' }}</p>
                            <p><strong>Numéro de passeport:</strong> {{ $guest->passport_number ?? 'Non spécifié' }}</p>
                            <p><strong>Notes:</strong> {{ $guest->notes ?? 'Aucune note' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">Supprimer</button>
                    </form>
                    <a href="{{ route('guests.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection