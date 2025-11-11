@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des Chambres</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Chambres</h2>
                <a href="{{ route('rooms.create') }}" class="btn btn-primary">Ajouter une Chambre</a>
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
                            <th>Photo</th>
                            <th>Numéro</th>
                            <th>Hôtel</th>
                            <th>Type</th>
                            <th>Étage</th>
                            <th>Prix</th>
                            <th>Disponible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>
                                @if($room->image_path)
                                    <img src="{{ asset('storage/' . $room->image_path) }}" alt="Photo chambre {{ $room->room_number }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-muted">N/A</span>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->hotel->name }}</td>
                            <td>{{ $room->roomType->name }}</td>
                            <td>{{ $room->floor }}</td>
                            <td>{{ number_format($room->price, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $room->is_available ? 'Oui' : 'Non' }}</td>
                            <td>
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette chambre?')">Supprimer</button>
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