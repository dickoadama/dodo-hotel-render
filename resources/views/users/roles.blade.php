@extends('layouts.app')

@section('title', 'Rôles et Permissions - DODO Hotel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-user-shield"></i> Rôles et Permissions</h1>
            
            <div class="card">
                <div class="card-header">
                    <h4>Description des rôles</h4>
                </div>
                <div class="card-body">
                    <p class="lead">Notre système utilise trois rôles principaux pour gérer les accès et permissions :</p>
                    
                    <div class="row">
                        <!-- Administrateur -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5><i class="fas fa-user-cog"></i> Administrateur</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">L'administrateur a tous les droits sur l'application.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success"></i> Gestion des utilisateurs</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des hôtels</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des chambres</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des réservations</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des factures</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des employés</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des clients</li>
                                        <li><i class="fas fa-check text-success"></i> Modification de toutes les données</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Employé -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-info">
                                <div class="card-header bg-info text-white">
                                    <h5><i class="fas fa-user-tie"></i> Employé</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">L'employé peut gérer les opérations quotidiennes.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-times text-danger"></i> Gestion des utilisateurs</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des hôtels</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des chambres</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des réservations</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des factures</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des employés</li>
                                        <li><i class="fas fa-check text-success"></i> Gestion des clients</li>
                                        <li><i class="fas fa-times text-danger"></i> Modification de toutes les données</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Client -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-secondary">
                                <div class="card-header bg-secondary text-white">
                                    <h5><i class="fas fa-user"></i> Client</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Le client a un accès limité à ses propres données.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-times text-danger"></i> Gestion des utilisateurs</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des hôtels</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des chambres</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des réservations</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des factures</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des employés</li>
                                        <li><i class="fas fa-times text-danger"></i> Gestion des clients</li>
                                        <li><i class="fas fa-times text-danger"></i> Modification de toutes les données</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Matrice des permissions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Fonctionnalité</th>
                                    <th>Administrateur</th>
                                    <th>Employé</th>
                                    <th>Client</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Connexion</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des utilisateurs</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des hôtels</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des chambres</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des réservations</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des factures</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des employés</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Gestion des clients</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Modification de données</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>Accès au tableau de bord</td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection