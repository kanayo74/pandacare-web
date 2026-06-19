<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pandacare - Your Complete Healthcare Companion')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* Custom Blue & White Theme */
        :root {
            --pc-primary: #0057b8;
            --pc-primary-dark: #003f8a;
            --pc-primary-light: #e8f1fc;
            --pc-secondary: #00b4d8;
            --pc-white: #ffffff;
            --pc-gray-light: #f8f9fa;
            --pc-gray: #6c757d;
            --pc-dark: #0d1b2a;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--pc-dark);
            background-color: var(--pc-white);
        }

        /* Navigation - Blue & White */
        .navbar {
            background: var(--pc-white) !important;
            border-bottom: 2px solid var(--pc-primary-light);
            padding: 0.8rem 0;
        }

        .navbar-brand img {
            height: 45px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--pc-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--pc-primary) !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--pc-primary);
            border-radius: 2px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 12px;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: var(--pc-primary-light);
            color: var(--pc-primary);
            padding-left: 1.8rem;
        }

        /* Primary Button */
        .btn-primary {
            background: var(--pc-primary);
            border: 2px solid var(--pc-primary);
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--pc-primary-dark);
            border-color: var(--pc-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,87,184,0.3);
        }

        .btn-outline-primary {
            border: 2px solid var(--pc-primary);
            color: var(--pc-primary);
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--pc-primary);
            color: var(--pc-white);
            transform: translateY(-2px);
        }

        /* Footer - Blue & White */
        footer {
            background: linear-gradient(135deg, var(--pc-primary) 0%, var(--pc-primary-dark) 100%) !important;
            color: var(--pc-white) !important;
        }

        footer a {
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--pc-white) !important;
            padding-left: 5px;
        }

        footer .btn-outline-light {
            border: 2px solid rgba(255,255,255,0.3);
            color: var(--pc-white);
            transition: all 0.3s ease;
        }

        footer .btn-outline-light:hover {
            background: var(--pc-white);
            color: var(--pc-primary);
            border-color: var(--pc-white);
        }

        footer hr {
            background-color: rgba(255,255,255,0.2);
        }

        /* Social Icons */
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: var(--pc-white);
            transform: translateY(-3px);
        }

        .social-icon:hover i {
            color: var(--pc-primary) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .nav-link.active::after {
                display: none;
            }
            
            .btn-primary {
                margin-top: 1rem;
                width: 100%;
                text-align: center;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation - Blue & White Theme -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Pandacare" height="50">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i>About Us
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('services*') ? 'active' : '' }}" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-stethoscope me-1"></i>Services
                        </a>
                        <ul class="dropdown-menu">
                            @php
                                $services = App\Models\Service::where('is_active', true)->orderBy('order')->get();
                            @endphp
                            @foreach($services as $service)
                                <li>
                                    <a class="dropdown-item" href="{{ route('service.detail', $service->slug) }}">
                                        <i class="fas {{ $service->icon }} me-2"></i>{{ $service->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">
                            <i class=""></i>Health News
                        </a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer - Blue & White Theme -->
    <footer class="text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Pandacare" height="45" class="mb-3">
                    <p class="text-white-50">Your complete healthcare companion. Access quality healthcare anytime, anywhere with verified medical professionals.</p>
                    <div class="mt-3">
                        <a href="https://play.google.com/store/apps/details?id=app.pandacare.com" class="btn btn-outline-light me-2 mb-2" target="_blank">
                            <i class="fab fa-google-play me-2"></i>Google Play
                        </a>
                        <a href="https://apps.apple.com/ng/app/pandacare-app/id6755859705" class="btn btn-outline-light mb-2" target="_blank">
                            <i class="fab fa-apple me-2"></i>App Store
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3 fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('services') }}" class="text-white-50 text-decoration-none">Services</a></li>
                        <li class="mb-2"><a href="{{ route('news') }}" class="text-white-50 text-decoration-none">Health News</a></li>
                        <li class="mb-2"><a href="{{ route('sports') }}" class="text-white-50 text-decoration-none">Sports</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3 fw-bold">Our Services</h5>
                    <ul class="list-unstyled">
                        @foreach($services ?? App\Models\Service::where('is_active', true)->take(6)->get() as $service)
                            <li class="mb-2"><a href="{{ route('service.detail', $service->slug) }}" class="text-white-50 text-decoration-none">{{ $service->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h5 class="mb-3 fw-bold">Contact Info</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:support@pandacare.com" class="text-white-50 text-decoration-none">support@pandacare.com</a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:+2348137217304" class="text-white-50 text-decoration-none">+234 813 721 7304</a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span class="text-white-50">Plot 26, Nigerian House Phase 4, Bwari, FCT, Nigeria</span>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <a href="#" class="social-icon me-2">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="#" class="social-icon me-2">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        <a href="#" class="social-icon me-2">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white-50">&copy; {{ date('Y') }} PANDACARE MEDICARE LTD. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white-50 text-decoration-none me-3">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-white-50 text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // Add active class to current nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentLocation) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>