@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier un Type de Chambre</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('room-types.update', $roomType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du type de chambre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $roomType->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $roomType->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="base_price" class="form-label">Prix de base (FCFA)</label>
                    <input type="number" class="form-control" id="base_price" name="base_price" value="{{ old('base_price', $roomType->base_price) }}" step="1" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacité (nombre de personnes)</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $roomType->capacity) }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="ventilation" class="form-label">Ventilation</label>
                    <select class="form-control" id="ventilation" name="ventilation" required>
                        <option value="climatisee" {{ old('ventilation', $roomType->ventilation) == 'climatisee' ? 'selected' : '' }}>Climatisée</option>
                        <option value="ventilee" {{ old('ventilation', $roomType->ventilation) == 'ventilee' ? 'selected' : '' }}>Ventilée</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour le type de chambre</button>
                <a href="{{ route('room-types.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection