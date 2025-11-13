@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe - DODO Hotel')

@section('content')
<style>
    .auth-container {
        position: relative;
        min-height: 400px;
    }
    
    .auth-form {
        position: absolute;
        width: 100%;
        padding: 2rem;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: center;
    }
    
    .auth-form.slide-in {
        animation: slideIn 0.6s ease forwards;
    }
    
    .auth-form.slide-out {
        animation: slideOut 0.6s ease forwards;
    }
    
    @keyframes slideIn {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        0% {
            transform: translateX(0);
            opacity: 1;
        }
        100% {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .form-title {
        position: relative;
        margin-bottom: 2rem;
        color: #333;
    }
    
    .form-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 3px;
    }
    
    .form-control {
        border: 2px solid #e1e1e1;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-auth {
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-auth::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: 0.5s;
    }
    
    .btn-auth:hover::before {
        left: 100%;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    
    .switch-form-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .switch-form-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #667eea;
        transition: width 0.3s ease;
    }
    
    .switch-form-link:hover::after {
        width: 100%;
    }
    
    .switch-form-link:hover {
        color: #764ba2;
        text-decoration: none;
    }
    
    .floating-animation {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-15">
                <div class="card-header bg-transparent border-0 text-center py-4">
                    <h2 class="mb-0 text-primary floating-animation">
                        <i class="fas fa-hotel me-2"></i>DODO Hotel
                    </h2>
                    <p class="text-muted mt-2">Réinitialisation du mot de passe</p>
                </div>

                <div class="card-body p-0">
                    @if ($errors->any())
                        <div class="alert alert-danger mx-4 mt-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="auth-container">
                        <!-- Reset Password Form -->
                        <div id="reset-password-form" class="auth-form slide-in">
                            <h3 class="text-center form-title">Réinitialiser le mot de passe</h3>
                            <p class="text-center text-muted mb-4">Entrez votre nouveau mot de passe</p>
                            
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                
                                <input type="hidden" name="token" value="{{ $token }}">
                                
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">Adresse email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">Nouveau mot de passe</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password" placeholder="Entrez votre nouveau mot de passe">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label fw-bold">Confirmer le mot de passe</label>
                                    <input id="password-confirm" type="password" class="form-control" 
                                           name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez votre nouveau mot de passe">
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-auth btn-primary pulse-animation">
                                        <i class="fas fa-key me-2"></i>Réinitialiser le mot de passe
                                    </button>
                                </div>
                            </form>
                            
                            <div class="text-center mt-4 pt-3 border-top">
                                <p class="mb-0">
                                    <a href="{{ route('login') }}" class="switch-form-link">Retour à la connexion</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection