@extends('layouts.app')

@section('title', 'Détails de la Caisse - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails de la Caisse</h1>

            <div class="card">
                <div class="card-header">
                    <h2>{{ $cashRegister->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Description:</strong> {{ $cashRegister->description ?? 'Aucune description' }}</p>
                            <p><strong>Solde initial:</strong> {{ number_format($cashRegister->balance, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Total des entrées:</strong> {{ number_format($cashRegister->total_income, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total des dépenses:</strong> {{ number_format($cashRegister->total_expense, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Solde actuel:</strong> {{ number_format($cashRegister->current_balance, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Statut:</strong> 
                                @if($cashRegister->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('cash-registers.edit', $cashRegister->id) }}" class="btn btn-warning">Modifier</a>
                    <a href="{{ route('transactions.create', ['cash_register_id' => $cashRegister->id]) }}" class="btn btn-primary">Ajouter une transaction</a>
                    <a href="{{ route('transactions.index', ['cash_register_id' => $cashRegister->id]) }}" class="btn btn-info">Voir les transactions</a>
                    <form action="{{ route('cash-registers.destroy', $cashRegister->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette caisse?')">Supprimer</button>
                    </form>
                    <a href="{{ route('cash-registers.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h3>Résumé des transactions</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Catégorie</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cashRegister->transactions->take(10) as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                    <td>
                                        @if($transaction->type == 'income')
                                            <span class="badge bg-success">Entrée</span>
                                        @else
                                            <span class="badge bg-danger">Dépense</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaction->category ?? 'Non spécifiée' }}</td>
                                    <td>{{ $transaction->description ?? 'Aucune description' }}</td>
                                    <td>{{ number_format($transaction->amount, 0, ',', ' ') }} FCFA</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection