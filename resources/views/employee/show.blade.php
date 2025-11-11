@extends('layouts.app')

@section('title', 'Détails de l\'Employé - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails de l'Employé</h1>

            <div class="card">
                <div class="card-header">
                    <h2>{{ $employee->first_name }} {{ $employee->last_name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $employee->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $employee->phone }}</p>
                            <p><strong>Poste:</strong> {{ $employee->position }}</p>
                            <p><strong>Département:</strong> {{ $employee->department }}</p>
                            <p><strong>Salaire:</strong> {{ number_format($employee->salary, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date d'embauche:</strong> {{ $employee->hire_date->format('d/m/Y') }}</p>
                            <p><strong>Statut:</strong> 
                                @if($employee->is_active)
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-danger">Inactif</span>
                                @endif
                            </p>
                            <p><strong>Adresse:</strong> {{ $employee->address ?? 'Non spécifiée' }}</p>
                            <p><strong>Date de naissance:</strong> {{ $employee->date_of_birth ? $employee->date_of_birth->format('d/m/Y') : 'Non spécifiée' }}</p>
                            <p><strong>Numéro de pièce d'identité:</strong> {{ $employee->national_id ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé?')">Supprimer</button>
                    </form>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection