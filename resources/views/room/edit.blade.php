@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier une Chambre</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="room_number" class="form-label">Numéro de chambre</label>
                    <input type="text" class="form-control" id="room_number" name="room_number" value="{{ old('room_number', $room->room_number) }}" required>
                </div>

                <div class="mb-3">
                    <label for="hotel_id" class="form-label">Hôtel</label>
                    <select class="form-control" id="hotel_id" name="hotel_id" required>
                        <option value="">Sélectionnez un hôtel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ old('hotel_id', $room->hotel_id) == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="room_type_id" class="form-label">Type de chambre</label>
                    <select class="form-control" id="room_type_id" name="room_type_id" required>
                        <option value="">Sélectionnez un type de chambre</option>
                        @foreach($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}" {{ old('room_type_id', $room->room_type_id) == $roomType->id ? 'selected' : '' }}>
                                {{ $roomType->name }} ({{ number_format($roomType->base_price, 0, ',', ' ') }} FCFA)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="floor" class="form-label">Étage</label>
                    <input type="text" class="form-control" id="floor" name="floor" value="{{ old('floor', $room->floor) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $room->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix (FCFA)</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $room->price) }}" step="1" min="0">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Photo de la chambre</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @if($room->image_path)
                        <div class="mt-2">
                            <p><strong>Photo actuelle :</strong></p>
                            <img src="{{ asset('storage/' . $room->image_path) }}" alt="Photo de la chambre" class="img-fluid" style="max-height: 200px;">
                        </div>
                    @endif
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_available" name="is_available" value="1" {{ old('is_available', $room->is_available) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available">Disponible</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour la chambre</button>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
</div>
@endsection