<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Solipet | Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/logo.ico">
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fef7f1;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #F3E5D0 0%, #E8C7AA 50%, #DDB892 100%);
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            padding: 2rem 1rem;
        }

        .sidebar h4 {
            font-family: 'Irish Grover', serif;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #8B4513;
        }

        .sidebar a {
            display: block;
            font-weight: 600;
            color: #4B3621;
            padding: 10px 15px;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #e4b07e;
            color: #fff;
        }

        .main-content {
            padding: 2rem;
            background-color: #fff8f0;
        }

        .navbar {
            background-color: #fff4e6;
            border-bottom: 1px solid #e3c9b3;
        }

        .navbar .navbar-brand {
            font-family: 'Irish Grover', serif;
            color: #A0522D !important;
        }

        .navbar .navbar-text {
            color: #4B3621;
        }
    </style>

    @yield('styles')
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Admin</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products') ? 'active' : '' }}"><i class="fas fa-box me-2"></i> Products</a>
        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
        <a href="{{ route('admin.customers') }}" class="{{ request()->routeIs('admin.customers') ? 'active' : '' }}"><i class="fas fa-users me-2"></i> Customers</a>
        <a href="{{ route('admin.inventory') }}" class="{{ request()->routeIs('admin.inventory') ? 'active' : '' }}"><i class="fas fa-warehouse me-2"></i> Inventory</a>
        <a href="{{ route('admin.promotions') }}" class="{{ request()->routeIs('admin.promotions') ? 'active' : '' }}"><i class="fas fa-tags me-2"></i> Promotions</a>
        <a href="{{ route('admin.payments') }}" class="{{ request()->routeIs('admin.payments') ? 'active' : '' }}"><i class="fas fa-credit-card me-2"></i> Payments</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <nav class="navbar navbar-expand px-4 py-2 shadow-sm">
            <div class="container-fluid justify-content-between">
                <span class="navbar-brand">SoliPet Admin Panel</span>
                <span class="navbar-text">
                    Welcome, {{ auth()->user()->name ?? 'Admin' }}
                </span>
            </div>
        </nav>

        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
