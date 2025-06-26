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
            width: 20%;
            padding: 3%;
            font-size: 1.2em;
            font-weight: bolder;

            i {
                padding-right: 2%;
            }
        }
    </style>
</head>
<body class="main">
    <div class="flex min-h-screen">
        <div class="sidebar">
            <div class="flex items-center mb-8">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="{{ asset('assets/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }} Logo" style="height: 40px;">
                </a>
                <img src="{{ asset('assets/company_logo.svg') }}" alt="Company Logo" style="height: 40px; margin-left: 10px;">
            </div>
            
            <h2 class="text-lg font-semibold mb-6">ORDER MANAGEMENT</h2>
            
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
                    PAYMENT AND SHIPPING
                </a>
                
                <a href="{{ route('admin.promotions') }}" class="flex items-center p-3 rounded-lg hover:bg-[#572215] {{ request()->routeIs('admin.promotions') ? 'active-nav' : '' }}">
                    <i class="fas fa-percentage mr-3"></i>
                    PROMOTIONS
                </a>
            </nav>
        </div>
        
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>