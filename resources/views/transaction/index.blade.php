@extends('layouts.app')

@section('title', 'Transactions - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Transactions</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Transactions</h2>
                @if(request('cash_register_id'))
                    <a href="{{ route('transactions.create', ['cash_register_id' => request('cash_register_id')]) }}" class="btn btn-primary">Ajouter une Transaction</a>
                @else
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Ajouter une Transaction</a>
                @endif
            </div>

            <!-- Filtres -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Filtres</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('transactions.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="cash_register_id" class="form-label">Caisse</label>
                                    <select class="form-control" id="cash_register_id" name="cash_register_id">
                                        <option value="">Toutes les caisses</option>
                                        @foreach($cashRegisters as $register)
                                            <option value="{{ $register->id }}" {{ request('cash_register_id') == $register->id ? 'selected' : '' }}>
                                                {{ $register->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="">Tous les types</option>
                                        <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Entrées</option>
                                        <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Dépenses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Date de début</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Date de fin</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Réinitialiser</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Résumé des totaux -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total des Entrées</h5>
                            <p class="card-text">{{ number_format($totalIncome, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total des Dépenses</h5>
                            <p class="card-text">{{ number_format($totalExpense, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Solde Net</h5>
                            <p class="card-text">{{ number_format($netBalance, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Caisse</th>
                            <th>Type</th>
                            <th>Catégorie</th>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Référence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                            <td>{{ $transaction->cashRegister->name }}</td>
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
                            <td>{{ $transaction->reference ?? 'Aucune' }}</td>
                            <td>
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection