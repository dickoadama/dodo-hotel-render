@extends('layouts.app')

@section('title', 'DODO Hotel - Accueil')

@section('content')
<div class="container-fluid px-0 mt-5"> <!-- Changement de mt-4 à mt-5 pour plus d'éloignement -->
    <!-- Diaporama -->
    <div id="hotelCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#hotelCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="slide-background slide-1">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- Logo de l'hôtel -->
                        <div class="hotel-logo mb-3">
                            <i class="fas fa-hotel fa-3x text-white"></i>
                        </div>
                        <h2 class="display-5 fw-bold">Bienvenue au DODO Hotel</h2>
                        <p class="lead">Votre confort est notre priorité</p>
                        <a href="{{ route('reservations.index') }}" class="btn btn-primary btn-lg">Réserver maintenant</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="slide-background slide-2">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- Logo de l'hôtel -->
                        <div class="hotel-logo mb-3">
                            <i class="fas fa-hotel fa-3x text-white"></i>
                        </div>
                        <h2 class="display-5 fw-bold">Chambres Luxueuses</h2>
                        <p class="lead">Détendez-vous dans nos chambres confortables</p>
                        <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-lg">Découvrir nos chambres</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="slide-background slide-3">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- Logo de l'hôtel -->
                        <div class="hotel-logo mb-3">
                            <i class="fas fa-hotel fa-3x text-white"></i>
                        </div>
                        <h2 class="display-5 fw-bold">Services Exceptionnels</h2>
                        <p class="lead">Profitez de nos services haut de gamme</p>
                        <a href="#services" class="btn btn-primary btn-lg">Voir nos services</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>

    <!-- Contenu principal -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center animate-card">
                    <div class="card-body">
                        <i class="fas fa-bed fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">Chambres Confortables</h3>
                        <p class="card-text">Nos chambres sont entièrement équipées pour votre confort avec vue panoramique sur la ville.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center animate-card">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">Restaurant & Bar</h3>
                        <p class="card-text">Dégustez nos plats raffinés préparés par nos chefs talentueux dans un cadre élégant.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center animate-card">
                    <div class="card-body">
                        <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">Spa & Bien-être</h3>
                        <p class="card-text">Détendez-vous dans notre espace spa avec piscine, sauna et massages revitalisants.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-md-6">
                <h2 class="mb-4">DODO Hotel</h2>
                <p class="lead">Situé au cœur de la ville, notre hôtel vous offre un séjour inoubliable avec des services de qualité supérieure.</p>
                <p>Notre équipe dévouée est à votre disposition 24h/24 pour répondre à tous vos besoins et vous garantir un séjour des plus agréables.</p>
                <a href="{{ route('hotels.index') }}" class="btn btn-outline-primary">En savoir plus</a>
            </div>
            <div class="col-md-6">
                <div class="bg-light p-4 rounded">
                    <h3 class="mb-4">Réservez votre séjour</h3>
                    <form>
                        <div class="mb-3">
                            <label for="checkin" class="form-label">Date d'arrivée</label>
                            <input type="date" class="form-control" id="checkin">
                        </div>
                        <div class="mb-3">
                            <label for="checkout" class="form-label">Date de départ</label>
                            <input type="date" class="form-control" id="checkout">
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Nombre de personnes</label>
                            <select class="form-select" id="guests">
                                <option>1 personne</option>
                                <option>2 personnes</option>
                                <option>3 personnes</option>
                                <option>4 personnes</option>
                                <option>5+ personnes</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Vérifier la disponibilité</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Services -->
        <div id="services" class="my-5">
            <h2 class="text-center mb-5">Nos Services</h2>
            
            <!-- Services essentiels -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="mb-4"><i class="fas fa-concierge-bell"></i> Services essentiels</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Réception</h4>
                            <p class="card-text">Ouverte 24h/24 pour accueillir les clients et gérer leurs demandes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Entretien ménager</h4>
                            <p class="card-text">Nettoyage quotidien des chambres, des espaces communs et blanchisserie.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Services de chambre</h4>
                            <p class="card-text">Gestion de la buanderie et du service d'étage.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Services de restauration -->
            <div class="row my-4">
                <div class="col-12">
                    <h3 class="mb-4"><i class="fas fa-utensils"></i> Services de restauration</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Petit-déjeuner</h4>
                            <p class="card-text">Souvent proposé sous forme de buffet ou à la carte.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Restaurant et bar</h4>
                            <p class="card-text">Offrent des repas et des boissons, parfois avec des options gastronomiques.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Service en chambre</h4>
                            <p class="card-text">Permet aux clients de commander des repas et d'autres services (comme des articles de toilette ou du linge frais) directement dans leur chambre.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Services de confort et bien-être -->
            <div class="row my-4">
                <div class="col-12">
                    <h3 class="mb-4"><i class="fas fa-spa"></i> Services de confort et bien-être</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Piscine</h4>
                            <p class="card-text">Espace aquatique, parfois chauffé.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Spa et massages</h4>
                            <p class="card-text">Offrent des moments de détente et de relaxation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Salle de sport</h4>
                            <p class="card-text">Permet aux clients de rester actifs pendant leur séjour.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Sauna</h4>
                            <p class="card-text">Propose des séances de vapeur et de détente.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Services pratiques et premium -->
            <div class="row my-4">
                <div class="col-12">
                    <h3 class="mb-4"><i class="fas fa-star"></i> Services pratiques et premium</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Conciergerie</h4>
                            <p class="card-text">Aide les clients à organiser des activités, faire des réservations ou obtenir des informations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Parking et transport</h4>
                            <p class="card-text">Inclut des options comme le service de voiturier, le parking privé, ou des navettes vers l'aéroport.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Services d'affaires</h4>
                            <p class="card-text">Centres d'affaires équipés d'imprimantes et de photocopieuses.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Services pour animaux de compagnie</h4>
                            <p class="card-text">Certains hôtels acceptent les animaux et peuvent offrir des services dédiés.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vidéo de présentation -->
        <div class="my-5 text-center">
            <h2 class="mb-4">Découvrez notre établissement</h2>
            <div class="ratio ratio-16x9">
                <video width="100%" height="100%" controls autoplay muted loop>
                    <source src="{{ asset('videos/hotel-presentation.mp4') }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            </div>
            <p class="mt-3">Une immersion virtuelle dans nos installations luxueuses</p>
        </div>
    </div>
</div>

<style>
    .slide-background {
        height: 50vh; /* Réduction de la hauteur de 80vh à 50vh */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }
    
    .slide-1 {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
    }
    
    .slide-2 {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
    }
    
    .slide-3 {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                          url('https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
    }
    
    .carousel-caption {
        bottom: 20%; /* Ajustement de la position */
        transform: translateY(30%);
    }
    
    .hotel-logo {
        animation: pulse 2s infinite;
    }
    
    .animate-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .animate-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
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
</style>

<script>
    // Animation des cartes au survol
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au défilement
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
        
        // Animation du diaporama
        const carousel = document.getElementById('hotelCarousel');
        carousel.addEventListener('slid.bs.carousel', function () {
            const activeItem = carousel.querySelector('.carousel-item.active');
            activeItem.querySelector('.carousel-caption').style.animation = 'none';
            setTimeout(() => {
                activeItem.querySelector('.carousel-caption').style.animation = 'fadeInUp 1s ease';
            }, 10);
        });
    });
</script>
@endsection