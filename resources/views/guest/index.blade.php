@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des Clients</h1>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des Clients</h2>
                <a href="{{ route('guests.create') }}" class="btn btn-primary">Ajouter un Client</a>
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
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Ville</th>
                            <th>Pays</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guests as $guest)
                        <tr>
                            <td>{{ $guest->last_name }}</td>
                            <td>{{ $guest->first_name }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->phone }}</td>
                            <td>{{ $guest->city }}</td>
                            <td>{{ $guest->country }}</td>
                            <td>
                                <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">Supprimer</button>
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