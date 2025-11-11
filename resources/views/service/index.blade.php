@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des Services</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Services</h2>
                <a href="{{ route('services.create') }}" class="btn btn-primary">Ajouter un Service</a>
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
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Disponible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->description ?? 'Aucune description' }}</td>
                            <td>{{ number_format($service->price, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $service->is_available ? 'Oui' : 'Non' }}</td>
                            <td>
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service?')">Supprimer</button>
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