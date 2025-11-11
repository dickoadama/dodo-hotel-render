@extends('layouts.app')

@section('title', 'Rapport Clients - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-users"></i> Analyse des clients</h1>
            
            <!-- Statistiques clients -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalGuests }}</h5>
                            <p class="card-text">Total clients</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">{{ $newGuestsThisMonth }}</h5>
                            <p class="card-text">Nouveaux clients ce mois</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalGuests > 0 ? round(($newGuestsThisMonth / $totalGuests) * 100, 2) : 0 }}%</h5>
                            <p class="card-text">Croissance mensuelle</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Clients les plus fréquents -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-crown"></i> Clients les plus fréquents</h4>
                        </div>
                        <div class="card-body">
                            @if($frequentGuests->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Réservations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($frequentGuests as $guest)
                                            <tr>
                                                <td>{{ $guest->first_name }} {{ $guest->last_name }}</td>
                                                <td>{{ $guest->email }}</td>
                                                <td>{{ $guest->reservations_count }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Aucune donnée disponible.</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Répartition par pays -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-globe"></i> Répartition par pays</h4>
                        </div>
                        <div class="card-body">
                            @if(count($guestsByCountry) > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pays</th>
                                                <th>Nombre de clients</th>
                                                <th>Pourcentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalCountryGuests = array_sum(array_column($guestsByCountry, 'count'));
                                            @endphp
                                            @foreach($guestsByCountry as $data)
                                            <tr>
                                                <td>{{ $data['country'] }}</td>
                                                <td>{{ $data['count'] }}</td>
                                                <td>{{ $totalCountryGuests > 0 ? round(($data['count'] / $totalCountryGuests) * 100, 2) : 0 }}%</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Aucune donnée disponible.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-chart-bar"></i> Insights clients</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Profil client</h5>
                            <ul>
                                <li>Vous avez un total de {{ $totalGuests }} clients dans votre base de données</li>
                                <li>{{ $newGuestsThisMonth }} nouveaux clients ont rejoint ce mois-ci</li>
                                <li>Votre taux de croissance mensuelle est de {{ $totalGuests > 0 ? round(($newGuestsThisMonth / $totalGuests) * 100, 2) : 0 }}%</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Stratégies de fidélisation</h5>
                            <ul>
                                <li>Identifiez et récompensez vos clients les plus fidèles</li>
                                <li>Personnalisez les offres pour les clients fréquents</li>
                                <li>Améliorez l'expérience client pour augmenter la rétention</li>
                                <li>Ciblez les marchés avec le plus grand potentiel de croissance</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection