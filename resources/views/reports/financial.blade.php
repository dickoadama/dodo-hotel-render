@extends('layouts.app')

@section('title', 'Rapport Financier - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-money-bill-wave"></i> Rapport financier</h1>
            
            <!-- Statistiques financières globales -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</h5>
                            <p class="card-text">Revenus totaux</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($totalExpenses, 0, ',', ' ') }} FCFA</h5>
                            <p class="card-text">Dépenses totales</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card text-white {{ $netProfit >= 0 ? 'bg-primary' : 'bg-warning' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($netProfit, 0, ',', ' ') }} FCFA</h5>
                            <p class="card-text">Bénéfice net</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($incomeTransactions, 0, ',', ' ') }} FCFA</h5>
                            <p class="card-text">Transactions entrantes</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Factures par statut -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-file-invoice"></i> Factures par statut</h4>
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
                                        @php
                                            $totalInvoices = array_sum($invoicesByStatus);
                                        @endphp
                                        <tr>
                                            <td><span class="badge bg-warning">En attente</span></td>
                                            <td>{{ $invoicesByStatus['pending'] }}</td>
                                            <td>{{ $totalInvoices > 0 ? round(($invoicesByStatus['pending'] / $totalInvoices) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-success">Payées</span></td>
                                            <td>{{ $invoicesByStatus['paid'] }}</td>
                                            <td>{{ $totalInvoices > 0 ? round(($invoicesByStatus['paid'] / $totalInvoices) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-danger">En retard</span></td>
                                            <td>{{ $invoicesByStatus['overdue'] }}</td>
                                            <td>{{ $totalInvoices > 0 ? round(($invoicesByStatus['overdue'] / $totalInvoices) * 100, 2) : 0 }}%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-secondary">Annulées</span></td>
                                            <td>{{ $invoicesByStatus['cancelled'] }}</td>
                                            <td>{{ $totalInvoices > 0 ? round(($invoicesByStatus['cancelled'] / $totalInvoices) * 100, 2) : 0 }}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Revenus mensuels -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-chart-line"></i> Revenus mensuels (12 derniers mois)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mois</th>
                                            <th>Revenus (FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($monthlyRevenue as $data)
                                        <tr>
                                            <td>{{ $data['month'] }}</td>
                                            <td>{{ number_format($data['revenue'], 0, ',', ' ') }}</td>
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
                    <h4><i class="fas fa-lightbulb"></i> Analyse financière</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tendances</h5>
                            <ul>
                                <li>Vos revenus ce mois-ci sont de {{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</li>
                                <li>Vos dépenses représentent {{ $totalRevenue > 0 ? round(($totalExpenses / $totalRevenue) * 100, 2) : 0 }}% de vos revenus</li>
                                <li>Votre marge bénéficiaire est de {{ $totalRevenue > 0 ? round(($netProfit / $totalRevenue) * 100, 2) : 0 }}%</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Recommandations</h5>
                            <ul>
                                <li>Surveillez régulièrement les factures en retard pour améliorer vos flux de trésorerie</li>
                                <li>Analysez les périodes de pointe pour optimiser vos tarifs</li>
                                <li>Identifiez les sources de revenus les plus lucratives</li>
                                <li>Contrôlez vos dépenses pour améliorer votre rentabilité</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection