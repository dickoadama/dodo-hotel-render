@extends('layouts.app')

@section('title', 'Détails de la Transaction - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails de la Transaction</h1>

            <div class="card">
                <div class="card-header">
                    <h2>Transaction #{{ $transaction->id }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Caisse:</strong> {{ $transaction->cashRegister->name }}</p>
                            <p><strong>Type:</strong> 
                                @if($transaction->type == 'income')
                                    <span class="badge bg-success">Entrée</span>
                                @else
                                    <span class="badge bg-danger">Dépense</span>
                                @endif
                            </p>
                            <p><strong>Catégorie:</strong> {{ $transaction->category ?? 'Non spécifiée' }}</p>
                            <p><strong>Description:</strong> {{ $transaction->description ?? 'Aucune description' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Montant:</strong> {{ number_format($transaction->amount, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Date:</strong> {{ $transaction->transaction_date->format('d/m/Y') }}</p>
                            <p><strong>Référence:</strong> {{ $transaction->reference ?? 'Aucune' }}</p>
                            <p><strong>Notes:</strong> {{ $transaction->notes ?? 'Aucune note' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction?')">Supprimer</button>
                    </form>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection