@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier un Hôtel</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'hôtel</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $hotel->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $hotel->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $hotel->city) }}" required>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Pays</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $hotel->country) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $hotel->phone) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $hotel->email) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $hotel->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="geographical_location" class="form-label">Situation géographique</label>
                    <textarea class="form-control" id="geographical_location" name="geographical_location" rows="3">{{ old('geographical_location', $hotel->geographical_location) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $hotel->latitude) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $hotel->longitude) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="star_rating" class="form-label">Nombre d'étoiles</label>
                    <select class="form-control" id="star_rating" name="star_rating" required>
                        <option value="0" {{ old('star_rating', $hotel->star_rating) == 0 ? 'selected' : '' }}>0 étoile</option>
                        <option value="1" {{ old('star_rating', $hotel->star_rating) == 1 ? 'selected' : '' }}>1 étoile</option>
                        <option value="2" {{ old('star_rating', $hotel->star_rating) == 2 ? 'selected' : '' }}>2 étoiles</option>
                        <option value="3" {{ old('star_rating', $hotel->star_rating) == 3 ? 'selected' : '' }}>3 étoiles</option>
                        <option value="4" {{ old('star_rating', $hotel->star_rating) == 4 ? 'selected' : '' }}>4 étoiles</option>
                        <option value="5" {{ old('star_rating', $hotel->star_rating) == 5 ? 'selected' : '' }}>5 étoiles</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour l'hôtel</button>
                <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection