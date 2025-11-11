@extends('layouts.app')

@section('title', 'Gestion de la Caisse - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion de la Caisse</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Caisses</h2>
                <a href="{{ route('cash-registers.create') }}" class="btn btn-primary">Ajouter une Caisse</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Solde Initial</th>
                            <th>Total Entrées</th>
                            <th>Total Dépenses</th>
                            <th>Solde Actuel</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cashRegisters as $cashRegister)
                        <tr>
                            <td>{{ $cashRegister->name }}</td>
                            <td>{{ $cashRegister->description ?? 'Aucune description' }}</td>
                            <td>{{ number_format($cashRegister->balance, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($cashRegister->total_income, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($cashRegister->total_expense, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($cashRegister->current_balance, 0, ',', ' ') }} FCFA</td>
                            <td>
                                @if($cashRegister->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('cash-registers.show', $cashRegister->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('cash-registers.edit', $cashRegister->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="{{ route('transactions.index', ['cash_register_id' => $cashRegister->id]) }}" class="btn btn-primary btn-sm">Transactions</a>
                                <form action="{{ route('cash-registers.destroy', $cashRegister->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette caisse?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection