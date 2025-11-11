@extends('layouts.app')

@section('title', 'Accueil - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron bg-primary text-white p-5 rounded">
                <h1 class="display-4">Bienvenue dans DODO Hotel</h1>
                <p class="lead">Système de gestion complet pour hôtels et résidences</p>
                <hr class="my-4">
                <p>Gérez facilement vos hôtels, chambres, clients, réservations et services.</p>
                <a class="btn btn-light btn-lg" href="{{ route('hotels.index') }}" role="button">Commencer</a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-building"></i> Gestion des hôtels</h5>
                    <p class="card-text">Gérez plusieurs hôtels ou résidences avec leurs informations détaillées.</p>
                    <a href="{{ route('hotels.index') }}" class="btn btn-primary">Voir les hôtels</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-bed"></i> Gestion des chambres</h5>
                    <p class="card-text">Organisez vos chambres par hôtel, type et disponibilité.</p>
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Voir les chambres</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-check"></i> Gestion des réservations</h5>
                    <p class="card-text">Suivez toutes les réservations, check-in et check-out.</p>
                    <a href="{{ route('reservations.index') }}" class="btn btn-primary">Voir les réservations</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Gestion des clients</h5>
                    <p class="card-text">Gérez les informations de vos clients et leur historique.</p>
                    <a href="{{ route('guests.index') }}" class="btn btn-primary">Voir les clients</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-concierge-bell"></i> Gestion des services</h5>
                    <p class="card-text">Proposez et gérez les services supplémentaires de votre hôtel.</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary">Voir les services</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tags"></i> Types de chambres</h5>
                    <p class="card-text">Définissez les différents types de chambres disponibles.</p>
                    <a href="{{ route('room-types.index') }}" class="btn btn-primary">Voir les types</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection