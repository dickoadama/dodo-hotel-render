@extends('layouts.app')

@section('title', 'Inscription - DODO Hotel')

@section('content')
<style>
    .auth-container {
        position: relative;
        min-height: 500px;
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
    
    .btn-success {
        background: linear-gradient(135deg, #28a745, #20c997);
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
    
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
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
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-15">
                <div class="card-header bg-transparent border-0 text-center py-4">
                    <h2 class="mb-0 text-success floating-animation">
                        <i class="fas fa-hotel me-2"></i>DODO Hotel
                    </h2>
                    <p class="text-muted mt-2">Rejoignez notre communauté</p>
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
                        <!-- Register Form -->
                        <div id="register-form" class="auth-form slide-in">
                            <h3 class="text-center form-title">Créer un compte</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="register-name" class="form-label fw-bold">Nom complet</label>
                                    <input id="register-name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Entrez votre nom complet">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="register-email" class="form-label fw-bold">Adresse email</label>
                                    <input id="register-email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Entrez votre email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="register-password" class="form-label fw-bold">Mot de passe</label>
                                    <input id="register-password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password" placeholder="Entrez votre mot de passe">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="register-password-confirm" class="form-label fw-bold">Confirmer le mot de passe</label>
                                    <input id="register-password-confirm" type="password" class="form-control" 
                                           name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez votre mot de passe">
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-auth btn-success pulse-animation">
                                        <i class="fas fa-user-plus me-2"></i>S'inscrire
                                    </button>
                                </div>
                            </form>
                            
                            <div class="text-center mt-4 pt-3 border-top">
                                <p class="mb-0">Déjà un compte ? 
                                    <a href="{{ route('login') }}" class="switch-form-link">Se connecter</a>
                                </p>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <div id="login-form" class="auth-form d-none">
                            <h3 class="text-center form-title">Connexion</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">Adresse email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrez votre email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">Mot de passe</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password" placeholder="Entrez votre mot de passe">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-auth btn-primary pulse-animation">
                                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                    </button>
                                </div>
                                
                                <div class="text-center">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-muted small">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
                            </form>
                            
                            <div class="text-center mt-4 pt-3 border-top">
                                <p class="mb-0">Pas encore de compte ? 
                                    <a href="#" id="show-register" class="switch-form-link">S'inscrire maintenant</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const showRegisterLink = document.getElementById('show-register');
        const showLoginLink = document.getElementById('show-login');
        
        // Ajout de classes pour les animations
        registerForm.classList.add('slide-in');
        
        showRegisterLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Animation de sortie du formulaire de login
            loginForm.classList.remove('slide-in');
            loginForm.classList.add('slide-out');
            
            // Après l'animation, cacher le formulaire de login et afficher le formulaire d'inscription
            setTimeout(function() {
                loginForm.classList.add('d-none');
                loginForm.classList.remove('slide-out');
                
                registerForm.classList.remove('d-none');
                registerForm.classList.add('slide-in');
            }, 500);
        });
        
        showLoginLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Animation de sortie du formulaire d'inscription
            registerForm.classList.remove('slide-in');
            registerForm.classList.add('slide-out');
            
            // Après l'animation, cacher le formulaire d'inscription et afficher le formulaire de login
            setTimeout(function() {
                registerForm.classList.add('d-none');
                registerForm.classList.remove('slide-out');
                
                loginForm.classList.remove('d-none');
                loginForm.classList.add('slide-in');
            }, 500);
        });
    });
</script>
@endsection