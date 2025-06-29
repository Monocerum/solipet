@extends('admin.layout')

@section('title', 'Admin Dashboard')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Irish+Grover&display=swap');
    
    .main-container {
        width: 100%;
        min-height: 85vh;
        background: linear-gradient(135deg, #F3E5D0 0%, #E8C7AA 50%, #DDB892 100%);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .main-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.3) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(184, 134, 94, 0.2) 0%, transparent 50%);
        pointer-events: none;
    }

    .dashboard-content {
        position: relative;
        z-index: 1;
        padding: 2rem;
    }

    .dashboard-title {
        text-align: center;
        font-size: 3rem;
        font-family: "Irish Grover", serif;
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 50%, #CD853F 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 3rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .dashboard-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #8B4513, #CD853F);
        border-radius: 2px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2.5rem;
        margin-bottom: 2rem;
        justify-items: center;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s ease-out both;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--accent-gradient);
        border-radius: 20px 20px 0 0;
    }

    .stat-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
    border: 1px solid var(--accent-color);
    background: rgba(255, 255, 255, 0.98);
}

.stat-icon {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: rotate(5deg) scale(1.1);
    box-shadow: 0 0 12px var(--accent-color);
}

.stat-info h3 {
    position: relative;
    display: inline-block;
}

.stat-info h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0;
    height: 2px;
    background: var(--accent-color);
    transition: width 0.3s ease;
}

.stat-card:hover .stat-info h3::after {
    width: 100%;
}


    .stat-card.orders { --accent-color: #A0522D; --accent-light: #F3E5D0; --accent-gradient: linear-gradient(135deg, #C19A6B, #A0522D); }
    .stat-card.products { --accent-color: #8B5E3C; --accent-light: #E8C7AA; --accent-gradient: linear-gradient(135deg, #D2B48C, #8B5E3C); }
    .stat-card.customers { --accent-color: #B8860B; --accent-light: #F5DEB3; --accent-gradient: linear-gradient(135deg, #FFD39B, #B8860B); }
    .stat-card.revenue { --accent-color:rgb(97, 89, 78); --accent-light: #FFF8E1; --accent-gradient: linear-gradient(135deg, #E8C7AA, #D2B48C); }

    .stat-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        background: var(--accent-light);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .stat-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--accent-gradient);
        opacity: 0.1;
        border-radius: 18px;
    }

    .stat-icon i {
        font-size: 1.8rem;
        color: var(--accent-color);
        z-index: 1;
        position: relative;
    }

    .stat-info h3 {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: #374151;
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.025em;
    }

    .stat-value {
        font-family: 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent-color);
        margin: 0;
        line-height: 1;
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-content {
            gap: 1rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
        }

        .stat-icon i {
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>

@section('content')
<div class="main-container">
    <div class="dashboard-content">
        <h2 class="dashboard-title">ADMIN DASHBOARD</h2>
        
        <div class="stats-grid">
            <div class="stat-card orders">
                <div class="stat-content">
                    <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                    <div class="stat-info">
                        <h3>Total Orders</h3>
                        <p class="stat-value">{{ $totalOrders ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="stat-card products">
                <div class="stat-content">
                    <div class="stat-icon"><i class="fas fa-box"></i></div>
                    <div class="stat-info">
                        <h3>Total Products</h3>
                        <p class="stat-value">{{ $totalProducts ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="stat-card customers">
                <div class="stat-content">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Total Customers</h3>
                        <p class="stat-value">{{ $totalCustomers ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="stat-card revenue">
                <div class="stat-content">
                    <div class="stat-icon"><i class="fas fa-peso-sign"></i></div>
                    <div class="stat-info">
                        <h3>Total Revenue</h3>
                        <p class="stat-value">₱{{ number_format($totalRevenue ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
