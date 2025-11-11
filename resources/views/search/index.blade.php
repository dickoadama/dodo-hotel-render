@extends('layouts.app')

@section('title', 'Recherche - DODO Hotel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center"><i class="fas fa-search"></i> Recherche avancée</h1>
            
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('search.results') }}" method="GET">
                        <div class="mb-3">
                            <label for="query" class="form-label">Terme de recherche</label>
                            <input type="text" class="form-control" id="query" name="query" placeholder="Entrez votre terme de recherche..." required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de recherche</label>
                            <select class="form-select" id="type" name="type">
                                <option value="all">Tout</option>
                                <option value="hotels">Hôtels</option>
                                <option value="rooms">Chambres</option>
                                <option value="guests">Clients</option>
                                <option value="reservations">Réservations</option>
                                <option value="employees">Employés</option>
                                <option value="invoices">Factures</option>
                            </select>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h4><i class="fas fa-info-circle"></i> Conseils pour la recherche</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Utilisez des mots-clés spécifiques pour affiner vos résultats</li>
                        <li>Vous pouvez rechercher par nom, numéro, email, etc.</li>
                        <li>La recherche "Tout" vous permet de chercher dans toutes les catégories</li>
                        <li>Les résultats sont affichés par catégorie pour une meilleure organisation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection