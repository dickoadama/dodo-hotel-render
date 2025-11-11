@extends('layouts.app')

@section('title', 'Rapport Occupation - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-bed"></i> Rapport d'occupation des chambres</h1>
            
            <!-- Statistiques globales -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalRooms }}</h5>
                            <p class="card-text">Total chambres</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">{{ $occupiedRooms }}</h5>
                            <p class="card-text">Chambres occupées</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">{{ $availableRooms }}</h5>
                            <p class="card-text">Chambres disponibles</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">{{ $occupancyRate }}%</h5>
                            <p class="card-text">Taux d'occupation</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Réservations par statut -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-chart-pie"></i> Réservations par statut</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Statut</th>
                                            <th>Nombre</th>
                                            <th>Pourcentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="badge bg-warning">En attente</span></td>
                                            <td>{{ $reservationsByStatus['pending'] }}</td>
                                            <td>{{ $totalRooms > 0 ? round(($reservationsByStatus['pending'] / $totalRooms) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-primary">Confirmées</span></td>
                                            <td>{{ $reservationsByStatus['confirmed'] }}</td>
                                            <td>{{ $totalRooms > 0 ? round(($reservationsByStatus['confirmed'] / $totalRooms) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-success">Check-in</span></td>
                                            <td>{{ $reservationsByStatus['checked_in'] }}</td>
                                            <td>{{ $totalRooms > 0 ? round(($reservationsByStatus['checked_in'] / $totalRooms) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-secondary">Check-out</span></td>
                                            <td>{{ $reservationsByStatus['checked_out'] }}</td>
                                            <td>{{ $totalRooms > 0 ? round(($reservationsByStatus['checked_out'] / $totalRooms) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-danger">Annulées</span></td>
                                            <td>{{ $reservationsByStatus['cancelled'] }}</td>
                                            <td>{{ $totalRooms > 0 ? round(($reservationsByStatus['cancelled'] / $totalRooms) * 100, 2) : 0 }}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Occupation par hôtel -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-building"></i> Occupation par hôtel</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hôtel</th>
                                            <th>Chambres</th>
                                            <th>Occupées</th>
                                            <th>Disponibles</th>
                                            <th>Taux</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($occupancyByHotel as $data)
                                        <tr>
                                            <td>{{ $data['hotel']->name }}</td>
                                            <td>{{ $data['total_rooms'] }}</td>
                                            <td>{{ $data['occupied_rooms'] }}</td>
                                            <td>{{ $data['available_rooms'] }}</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $data['occupancy_rate'] }}%" 
                                                         aria-valuenow="{{ $data['occupancy_rate'] }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ $data['occupancy_rate'] }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-info-circle"></i> Recommandations</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Surveillez régulièrement le taux d'occupation pour ajuster vos stratégies de pricing</li>
                        <li>Identifiez les périodes creuses pour proposer des offres spéciales</li>
                        <li>Analysez les réservations annulées pour améliorer votre processus de confirmation</li>
                        <li>Comparez les taux d'occupation entre vos différents hôtels pour identifier les meilleures pratiques</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection