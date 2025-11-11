@extends('layouts.app')

@section('title', 'Ajouter une Transaction - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Ajouter une Transaction</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="cash_register_id" class="form-label">Caisse</label>
                    <select class="form-control" id="cash_register_id" name="cash_register_id" required>
                        <option value="">Sélectionnez une caisse</option>
                        @foreach($cashRegisters as $register)
                            <option value="{{ $register->id }}" {{ old('cash_register_id', request('cash_register_id')) == $register->id ? 'selected' : '' }}>
                                {{ $register->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Entrée</option>
                                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Dépense</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Montant (FCFA)</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" step="1" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="reference" class="form-label">Référence</label>
                    <input type="text" class="form-control" id="reference" name="reference" value="{{ old('reference') }}">
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter la transaction</button>
                @if(request('cash_register_id'))
                    <a href="{{ route('cash-registers.show', request('cash_register_id')) }}" class="btn btn-secondary">Annuler</a>
                @else
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Annuler</a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection