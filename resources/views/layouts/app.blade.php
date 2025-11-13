<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DODO Hotel - Gestion d\'hôtel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            background-attachment: fixed;
            overflow-x: hidden;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=20');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.1;
            z-index: -1;
        }
        
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(0, 123, 255, 0.9) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1000;
        }
        
        .navbar .nav-link,
        .navbar .navbar-brand {
            color: white !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }
        
        .navbar .nav-link:hover {
            color: #f8f9fa !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }
        
        .card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border-radius: 15px;
        }
        
        .rounded-15 {
            border-radius: 15px !important;
        }
        
        .footer {
            backdrop-filter: blur(10px);
            background-color: rgba(0, 0, 0, 0.8);
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Style pour le badge de notification */
        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 0.6rem;
        }
        
        /* Style pour la barre de recherche dans la navbar */
        .search-form {
            margin-right: 15px;
        }
        
        .search-form .form-control {
            border-radius: 20px 0 0 20px;
            border: none;
        }
        
        .search-form .btn {
            border-radius: 0 20px 20px 0;
            border: none;
        }
        
        /* Style pour les boutons flottants */
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .floating-button {
            display: block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            text-align: center;
            line-height: 50px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .floating-button:hover {
            transform: scale(1.1);
            background-color: #0056b3;
        }
        
        .floating-button i {
            font-size: 20px;
        }
        
        .floating-button.notifications {
            background-color: #28a745;
        }
        
        .floating-button.notifications:hover {
            background-color: #1e7e34;
        }
        
        .floating-button.chat {
            background-color: #ffc107;
            color: #212529;
        }
        
        .floating-button.chat:hover {
            background-color: #e0a800;
        }
        
        .floating-button.reports {
            background-color: #6f42c1;
        }
        
        .floating-button.reports:hover {
            background-color: #5a32a3;
        }
        
        /* Espacement pour le logo */
        .navbar-brand {
            margin-right: 70px;
        }
        
        /* Style pour l'avatar utilisateur */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid white;
        }
        
        .navbar-brand-container {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="navbar-brand-container">
                <i class="fas fa-hotel me-2"></i>
                @auth
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="user-avatar">
                    @else
                        <span class="user-avatar d-flex align-items-center justify-content-center bg-light text-dark fw-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    @endif
                @endauth
                @guest
                    <span>DODO Hotel</span>
                @endguest
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Lien Accueil seulement pour les utilisateurs non connectés -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    @endguest
                    
                    @auth
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line"></i> Tableau de bord
                        </a>
                    </li>
                    
                    <!-- Gestion Hôtelière -->
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-building"></i> Gestion Hôtelière
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}">Hôtels</a></li>
                            <li><a class="dropdown-item" href="{{ route('rooms.index') }}">Chambres</a></li>
                            <li><a class="dropdown-item" href="{{ route('room-types.index') }}">Types de chambres</a></li>
                        </ul>
                    </li>
                    
                    <!-- Gestion Clients -->
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-users"></i> Clients
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('guests.index') }}">Liste des clients</a></li>
                            <li><a class="dropdown-item" href="{{ route('reservations.index') }}">Réservations</a></li>
                        </ul>
                    </li>
                    
                    <!-- Gestion Employés -->
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-tie"></i> Employés
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('employees.index') }}">Liste des employés</a></li>
                        </ul>
                    </li>
                    
                    <!-- Gestion Financière -->
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-money-bill-wave"></i> Finances
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('cash-registers.index') }}">Caisse</a></li>
                            <li><a class="dropdown-item" href="{{ route('invoices.index') }}">Factures</a></li>
                            <li><a class="dropdown-item" href="{{ route('services.index') }}">Services</a></li>
                        </ul>
                    </li>
                    @endauth
                </ul>
                
                @auth
                <!-- Barre de recherche -->
                <form class="d-flex search-form" action="{{ route('search.results') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Rechercher..." aria-label="Rechercher">
                    <input type="hidden" name="type" value="all">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                @endauth
                
                <ul class="navbar-nav ms-auto">
                    <!-- Gestion Utilisateurs (Admin only) -->
                    @auth
                    @if(auth()->user()->isAdmin())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-cog"></i> Administration
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Gestion des utilisateurs</a></li>
                            <li><a class="dropdown-item" href="{{ route('roles') }}">Rôles et permissions</a></li>
                        </ul>
                    </li>
                    @endif
                    
                    <!-- User Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Mon profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.public', Auth::id()) }}">Voir mon profil public</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <!-- Guest Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Boutons flottants -->
    @auth
    <div class="floating-buttons">
        <a href="{{ route('reports') }}" class="floating-button reports" title="Rapports">
            <i class="fas fa-chart-bar"></i>
        </a>
        <a href="{{ route('notifications') }}" class="floating-button notifications" title="Notifications">
            <i class="fas fa-bell"></i>
            <span class="badge bg-danger notification-badge">3</span>
        </a>
        <a href="{{ route('chat') }}" class="floating-button chat" title="Chat">
            <i class="fas fa-comments"></i>
        </a>
    </div>
    @endauth

    <footer class="footer text-light mt-auto">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-hotel"></i> DODO Hotel</h5>
                    <p>Votre confort est notre priorité</p>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-address-book"></i> Contact</h5>
                    <p>
                        <i class="fas fa-phone"></i> Téléphone : 05 557 864 30 / 07 672 942 55<br>
                        <i class="fas fa-envelope"></i> Email : dickoadamad@mail.com / asaelaser@gmail.com
                    </p>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} DODO Hotel - Tous droits réservés</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation au défilement
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animateElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html>