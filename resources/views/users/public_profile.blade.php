@extends('layouts.app')

@section('title', 'Mon Profil Public - DODO Hotel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user"></i> Mon Profil Public</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>ID:</strong></div>
                        <div class="col-md-9">{{ $user->id }}</div>
                    </div>
                    
                    @if($user->first_name || $user->last_name)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Nom complet:</strong></div>
                        <div class="col-md-9">{{ $user->first_name }} {{ $user->last_name }}</div>
                    </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Nom d'utilisateur:</strong></div>
                        <div class="col-md-9">{{ $user->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Email:</strong></div>
                        <div class="col-md-9">{{ $user->email }}</div>
                    </div>
                    
                    @if($user->phone)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Téléphone:</strong></div>
                        <div class="col-md-9">{{ $user->phone }}</div>
                    </div>
                    @endif
                    
                    @if($user->date_of_birth)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Date de naissance:</strong></div>
                        <div class="col-md-9">{{ $user->date_of_birth->format('d/m/Y') }}</div>
                    </div>
                    @endif
                    
                    @if($user->gender)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Genre:</strong></div>
                        <div class="col-md-9">
                            @if($user->gender === 'male')
                                Homme
                            @elseif($user->gender === 'female')
                                Femme
                            @else
                                Autre
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    @if($user->address || $user->city || $user->country)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Adresse:</strong></div>
                        <div class="col-md-9">
                            @if($user->address)
                                {{ $user->address }}<br>
                            @endif
                            @if($user->city)
                                {{ $user->city }}
                                @if($user->country)
                                    , {{ $user->country }}
                                @endif
                            @elseif($user->country)
                                {{ $user->country }}
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    @if($user->bio)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Biographie:</strong></div>
                        <div class="col-md-9">{{ $user->bio }}</div>
                    </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Rôle:</strong></div>
                        <div class="col-md-9">
                            @if($user->role === 'admin')
                                <span class="badge bg-danger">Administrateur</span>
                            @elseif($user->role === 'employee')
                                <span class="badge bg-primary">Employé</span>
                            @else
                                <span class="badge bg-secondary">Client</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Membre depuis:</strong></div>
                        <div class="col-md-9">{{ $user->created_at->format('d/m/Y') }}</div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('profile') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Modifier mon profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection