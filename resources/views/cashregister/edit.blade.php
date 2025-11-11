@extends('layouts.app')

@section('title', 'Modifier une Caisse - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier une Caisse</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cash-registers.update', $cashRegister->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la caisse</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cashRegister->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $cashRegister->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="balance" class="form-label">Solde initial (FCFA)</label>
                    <input type="number" class="form-control" id="balance" name="balance" value="{{ old('balance', $cashRegister->balance) }}" step="1" min="0">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $cashRegister->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour la caisse</button>
                <a href="{{ route('cash-registers.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection