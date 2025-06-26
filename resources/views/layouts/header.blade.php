<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Koh+Santepheap:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        /* Base responsive styles */
        .navbar {
            padding: 0.5rem 0;
        }
        
        .navbar-brand img,
        .company-logo {
            height: 35px;
            transition: height 0.3s ease;
        }
        
        .search-container {
            flex: 1;
            width: 650px;
            max-width: 650px;
            margin: 0 1rem;
        }
        
        .search-input {
            width: 100%;
            background-color: #f2d5bc !important;
            border: 1px solid #d4a574;
            border-radius: 0.375rem;
        }
        
        .search-btn {
            white-space: nowrap;
            min-width: 80px;
        }
        
        .nav-link-custom {
            color: #f2d5bc !important;
            font-size: 1.25rem !important;
            font-family: 'Manrope', sans-serif !important;
        }
        
        .dropdown-item-custom {
            color: #000000 !important;
            font-family: 'Manrope', sans-serif !important;
        }
        
        .cart-icon {
            height: 28px;
            vertical-align: middle;
        }
        
        /* Mobile-first responsive breakpoints */
        
        /* Extra small devices (phones, less than 576px) */
        @media (max-width: 575.98px) {
            .navbar-brand img,
            .company-logo {
                height: 28px;
            }
            
            .company-logo {
                display: none; /* Hide company logo on very small screens */
            }
            
            .search-container {
                margin: 0.5rem 0;
                order: 3;
                width: 100%;
            }
            
            .search-input {
                font-size: 14px;
            }
            
            .nav-link-custom {
                font-size: 1rem !important;
                padding: 0.5rem 0.75rem !important;
            }
            
            .cart-icon {
                height: 24px;
            }
            
            .navbar-nav {
                text-align: center;
            }
            
            .navbar-collapse {
                margin-top: 0.5rem;
            }
            
            /* Stack search form below navbar on mobile */
            .mobile-search {
                width: 100%;
                padding: 0.5rem 1rem;
                background-color: inherit;
            }
        }
        
        /* Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .navbar-brand img,
            .company-logo {
                height: 32px;
            }
            
            .search-container {
                width: 450px;
                max-width: 450px;
                margin: 0 0.75rem;
            }
            
            .search-input {
                width: 100%;
            }
            
            .nav-link-custom {
                font-size: 1.1rem !important;
            }
            
            .cart-icon {
                height: 26px;
            }
        }
        
        /* Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .search-container {
                width: 550px;
                max-width: 550px;
            }
            
            .search-input {
                width: 100%;
            }
            
            .company-logo {
                margin-left: 8px !important;
            }
        }
        
        /* Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {
            .search-container {
                width: 650px;
                max-width: 650px;
            }
            
            .search-input {
                width: 100%;
            }
        }
        
        /* Custom mobile navbar layout */
        @media (max-width: 767.98px) {
            .navbar-expand-md .navbar-nav {
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .navbar-expand-md .navbar-nav .nav-item {
                margin: 0 0.25rem;
            }
            
            .navbar-expand-md .navbar-collapse {
                justify-content: center;
            }
            
            .mobile-search-wrapper {
                display: block !important;
                width: 100%;
                order: 10;
                margin-top: 0.5rem;
                padding: 0 1rem;
            }
            
            .desktop-search-wrapper {
                display: none !important;
            }
        }
        
        @media (min-width: 768px) {
            .mobile-search-wrapper {
                display: none !important;
            }
            
            .desktop-search-wrapper {
                display: flex !important;
            }
        }
        
        /* Improve dropdown on mobile */
        @media (max-width: 767.98px) {
            .dropdown-menu {
                border: none;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                min-width: 120px;
            }
        }
        
        /* Center content and improve spacing */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        @media (max-width: 575.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }
        
        /* Accessibility improvements */
        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(242, 213, 188, 0.25);
        }
        
        .search-input:focus {
            border-color: #d4a574;
            box-shadow: 0 0 0 0.25rem rgba(212, 165, 116, 0.25);
        }
        
        .search-btn:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-brown shadow-sm">
            <div class="container">
                <!-- Brand and company logo -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand me-2" href="{{ url('/') }}">
                        <img src="{{ asset('assets/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }} Logo">
                    </a>
                    <img src="{{ asset('assets/company_logo.svg') }}" alt="Company Logo" class="company-logo" style="margin-left: 10px;">
                </div>

                <!-- Mobile navbar toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div style="width:30px;"></div>
                <!-- Desktop search form -->
                <div class="desktop-search-wrapper search-container mx-3">
                    <form class="d-flex w-100" role="search" method="GET" action="{{ route('searchpage') }}" id="searchForm">
                        <input class="form-control me-2 search-input" type="search" name="query" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-light search-btn" type="submit">Search</button>
                    </form>
                </div>

                <!-- Navbar collapse content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Mobile search form -->
                    <div class="mobile-search-wrapper d-none">
                        <form class="d-flex" role="search" method="GET" action="{{ route('searchpage') }}" id="mobileSearchForm">
                            <input class="form-control me-2 search-input" type="search" name="query" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-light search-btn" type="submit">Search</button>
                        </form>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom" href="{{ route('register') }}">{{ __('Signup') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle nav-link-custom" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item dropdown-item-custom" href="{{ route('userpage') }}">
                                        {{ __('My Profile') }}
                                    </a>

                                    <a class="dropdown-item dropdown-item-custom" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="{{ route('viewCart') }}">
                                    <img src="{{ asset('assets/cart.png') }}" alt="Cart" class="cart-icon">
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    
    <script>
        // Ensure mobile search form submission works
        document.addEventListener('DOMContentLoaded', function() {
            const mobileSearchForm = document.getElementById('mobileSearchForm');
            if (mobileSearchForm) {
                mobileSearchForm.addEventListener('submit', function(e) {
                    // Form will submit normally, no need to prevent default
                });
            }
        });
    </script>
</body>
</html>