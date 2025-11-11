@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier un Service</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du service</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $service->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix (FCFA)</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $service->price) }}" step="1" min="0" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_available" name="is_available" value="1" {{ old('is_available', $service->is_available) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available">Disponible</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour le service</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection