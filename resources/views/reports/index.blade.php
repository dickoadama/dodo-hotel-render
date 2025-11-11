@extends('layouts.app')

@section('title', 'Rapports et Analyses - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-chart-bar"></i> Rapports et Analyses</h1>
            
            <div class="row">
                <!-- Rapport d'occupation -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-bed fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Occupation des chambres</h5>
                            <p class="card-text">Analysez le taux d'occupation de vos chambres et l'état des réservations.</p>
                            <a href="{{ route('reports.occupancy') }}" class="btn btn-primary">
                                <i class="fas fa-chart-line"></i> Voir le rapport
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Rapport financier -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-money-bill-wave fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Rapport financier</h5>
                            <p class="card-text">Suivez vos revenus, dépenses et bénéfices sur différentes périodes.</p>
                            <a href="{{ route('reports.financial') }}" class="btn btn-success">
                                <i class="fas fa-chart-pie"></i> Voir le rapport
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Rapport clients -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Analyse des clients</h5>
                            <p class="card-text">Découvrez les tendances et comportements de vos clients.</p>
                            <a href="{{ route('reports.guest') }}" class="btn btn-info">
                                <i class="fas fa-user-chart"></i> Voir le rapport
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-info-circle"></i> À propos des rapports</h4>
                </div>
                <div class="card-body">
                    <p>Les rapports et analyses vous permettent de prendre des décisions éclairées pour améliorer la gestion de votre hôtel. Chaque rapport fournit des insights précieux sur différents aspects de votre activité :</p>
                    
                    <ul>
                        <li><strong>Occupation des chambres :</strong> Suivez le taux d'occupation, identifiez les périodes de pointe et optimisez votre stratégie tarifaire.</li>
                        <li><strong>Rapport financier :</strong> Analysez vos revenus et dépenses pour maximiser la rentabilité de votre hôtel.</li>
                        <li><strong>Analyse des clients :</strong> Comprenez les comportements de vos clients pour améliorer leur expérience et fidéliser votre clientèle.</li>
                    </ul>
                    
                    <p>Les rapports sont mis à jour en temps réel et peuvent être exportés au format PDF ou Excel pour un usage ultérieur.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection