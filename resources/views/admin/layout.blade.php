<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Solipet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .active-nav {
            background-color: #572215;
            color: white;
        }

        .main {
            color: #FFE2C9;
            font-family: "Manrope", sans-serif;
            background-color: #2E160C;
        }

        .sidebar {
            background-color: #1B0800;
            font-size: 1.2em;
            font-weight: bolder;
        }

        .sidebar i {
            padding-right: 2%;
        }

        /* Mobile overlay styles */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Mobile sidebar styles */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                height: 100vh;
                width: 80%;
                max-width: 320px;
                z-index: 50;
                transition: left 0.3s ease-in-out;
                overflow-y: auto;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                width: 100%;
            }
        }

        /* Desktop sidebar styles */
        @media (min-width: 769px) {
            .sidebar {
                width: 20%;
                position: relative;
            }
        }
    </style>
</head>
<body class="main">
    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    
    <!-- Mobile menu button -->
    <div class="md:hidden fixed top-4 left-4 z-30">
        <button 
            id="menuToggle" 
            onclick="toggleSidebar()" 
            class="p-3 rounded-lg bg-[#572215] text-white hover:bg-[#8B4513] transition-colors duration-200"
        >
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <div class="flex min-h-screen">
        <div class="sidebar p-6 md:p-[3%]" id="sidebar">
            <!-- Close button for mobile -->
            <div class="md:hidden flex justify-end mb-4">
                <button 
                    onclick="toggleSidebar()" 
                    class="p-2 rounded-lg hover:bg-[#572215] transition-colors duration-200"
                >
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="flex items-center mb-8">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="{{ asset('assets/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }} Logo" style="height: 40px;">
                </a>
                <img src="{{ asset('assets/company_logo.svg') }}" alt="Company Logo" style="height: 40px; margin-left: 10px;">
            </div>
            
            <!-- Back to Home Button -->
            <div class="mb-6">
                <a href="{{ route('home') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] transition-colors duration-200" style="background-color: #8B4513; color: white;">
                    <i class="fas fa-home mr-3"></i>
                    <span class="hidden sm:inline">BACK TO HOME</span>
                    <span class="sm:hidden">HOME</span>
                </a>
            </div>
            
            <h2 class="text-lg font-semibold mb-6 hidden sm:block">ORDER MANAGEMENT</h2>
            <h2 class="text-base font-semibold mb-6 sm:hidden">MANAGEMENT</h2>
            
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.dashboard') ? 'active-nav' : '' }}">
                    <i class="fas fa-th-large mr-3"></i>
                    DASHBOARD
                </a>
                
                <a href="{{ route('admin.orders') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.orders') ? 'active-nav' : '' }}">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    ORDERS
                </a>
                
                <a href="{{ route('admin.products') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.products') ? 'active-nav' : '' }}">
                    <i class="fas fa-box mr-3"></i>
                    PRODUCTS
                </a>
                
                <a href="{{ route('admin.inventory') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.inventory') ? 'active-nav' : '' }}">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    INVENTORY
                </a>
                
                <a href="{{ route('admin.customers') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.customers') ? 'active-nav' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    CUSTOMERS
                </a>
                
                <a href="{{ route('admin.payments') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.payments') ? 'active-nav' : '' }}">
                    <i class="fas fa-credit-card mr-3"></i>
                    <span class="hidden sm:inline">PAYMENT AND SHIPPING</span>
                    <span class="sm:hidden">PAYMENTS</span>
                </a>
            </nav>
        </div>
        
        <div class="flex-1 p-6 main-content pt-20 md:pt-6">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const menuIcon = document.querySelector('#menuToggle i');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Toggle menu icon
            if (sidebar.classList.contains('active')) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        }

        // Close sidebar when clicking on navigation links on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.sidebar nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const menuIcon = document.querySelector('#menuToggle i');
            
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        });
    </script>
</body>
</html>