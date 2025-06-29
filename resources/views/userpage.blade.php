@extends('layouts.header')

@section('content')
<div class="userpage-wrapper">
    <style>
    /* Move all userpage-specific styles here and scope them to .userpage-wrapper */
    .userpage-wrapper .dropdown-bar { margin-bottom: 20px; display: flex; padding-left: 5%; border-radius: 6px; }
    .userpage-wrapper .dropdown-bar > div { justify-content: flex-start; padding: 10px; display: flex; width: 100%; gap: 30px; height: 50px; }
    .userpage-wrapper .dropdown-pet { position: relative; width: 200px; }
    .userpage-wrapper .dropdown-pet1 { position: relative; width: 300px; }
    .userpage-wrapper .dropdown-pet .dropdown-toggle, .userpage-wrapper .dropdown-pet1 .dropdown-toggle { color: beige; font-family: 'Manrope', sans-serif; font-size: 1.25rem; font-weight: bold; }
    .userpage-wrapper .dropdown-pet .dropdown-toggle:hover,
    .userpage-wrapper .dropdown-pet .dropdown-toggle:focus,
    .userpage-wrapper .dropdown-pet .dropdown-toggle:active { color: white; text-decoration: none; }
    .userpage-wrapper .hero-section { width: 100%; display: flex; justify-content: center; align-items: center; margin-top: -20px; margin-bottom: 30px; }
    .userpage-wrapper .sidebar-catalog { color: beige; font-family: 'Manrope', sans-serif; margin-left: 20px; }
    .userpage-wrapper .sidebar-catalog h4,
    .userpage-wrapper .sidebar-catalog h5,
    .userpage-wrapper .sidebar-catalog label,
    .userpage-wrapper .sidebar-catalog a { color: #f2d5bc; }
    .userpage-wrapper .sidebar-catalog h5 { background-color: #2E160C; color: #f2d5bc; height: 40px; display: flex; align-items: center; justify-content: center; }
    .userpage-wrapper .userpage-flex-container { display: flex; min-height: 100vh; background: linear-gradient(135deg, #2c1810, #4a2c1a); position: relative; z-index: 1; }
    .userpage-wrapper .sidebar { width: 300px; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(10px); border-right: 1px solid rgba(255, 255, 255, 0.1); padding: 20px; display: flex; flex-direction: column; gap: 10px; z-index: 2; position: relative; }
    .userpage-wrapper .user-header { display: flex; align-items: center; gap: 15px; padding: 20px; background: rgba(255, 255, 255, 0.1); border-radius: 15px; margin-bottom: 20px; transition: all 0.3s ease; }
    .userpage-wrapper .user-header:hover { background: rgba(255, 255, 255, 0.15); transform: translateY(-2px); }
    .userpage-wrapper .user-avatar { width: 50px; height: 50px; background: linear-gradient(45deg, #ff6b6b, #4ecdc4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: bold; }
    .userpage-wrapper .user-info h3 { color: #f4f1eb; font-size: 18px; margin-bottom: 5px; }
    .userpage-wrapper .edit-profile { color: #d4af37; font-size: 12px; text-decoration: none; opacity: 0.8; transition: opacity 0.3s ease; }
    .userpage-wrapper .edit-profile:hover { opacity: 1; }
    .userpage-wrapper .sidebar-section { margin-bottom: 30px; }
    .userpage-wrapper .sidebar-title { color: #d4af37; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; padding: 0 20px 15px 20px; border-bottom: 1px solid rgba(212, 175, 55, 0.3); margin-bottom: 15px; }
    .userpage-wrapper .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 15px 20px; color: #f4f1eb; text-decoration: none; border-radius: 12px; transition: all 0.3s ease; cursor: pointer; margin-bottom: 5px; margin-left: 10px; border-left: 3px solid transparent; }
    .userpage-wrapper .sidebar-item:hover, .userpage-wrapper .sidebar-item.active { background: #372215; transform: translateX(5px); box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3); border-left-color: #f4f1eb; }
    .userpage-wrapper .nav-icon img{ width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; }
    .userpage-wrapper .main-content { flex: 1; padding: 40px; overflow-y: auto; z-index: 2; position: relative; }
    .userpage-wrapper .profile-card { background: #FFDDAF; padding: 40px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); max-width: 800px; margin: 0 auto; position: relative; overflow: hidden; }
    .userpage-wrapper .profile-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }
    @keyframes shimmer {
        0%, 100% { background-position: 200% 0; }
        50% { background-position: -200% 0; }
    }
    .userpage-wrapper .profile-header { text-align: center; margin-bottom: 40px; }
    .userpage-wrapper .profile-subtitle { color: #666; font-size: 16px; margin-top: 15px; font-weight: 300; }
    .userpage-wrapper .profile-title { font-size: 32px; color: #2c1810; margin-bottom: 10px; font-weight: 300; }
    .userpage-wrapper .profile-divider { width: 100px; height: 2px; background: linear-gradient(90deg, #d4af37, #b8941f); margin: 0 auto; }
    .userpage-wrapper .profile-form { display: grid; grid-template-columns: 1fr 200px; gap: 40px; align-items: start; }
    .userpage-wrapper .form-fields { display: grid; gap: 25px; }
    .userpage-wrapper .form-group { display: grid; grid-template-columns: 150px 1fr; gap: 20px; align-items: center; }
    .userpage-wrapper .form-label { font-weight: 600; color: #2c1810; font-size: 16px; }
    .userpage-wrapper .form-input { padding: 12px 16px; border: 2px solid #d4af37; border-radius: 10px; font-size: 16px; background: white; transition: all 0.3s ease; outline: none; }
    .userpage-wrapper .form-input:focus { border-color: #b8941f; box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1); transform: translateY(-1px); }
    .userpage-wrapper .gender-options { display: flex; gap: 20px; align-items: center; }
    .userpage-wrapper .radio-group { display: flex; align-items: center; gap: 8px; }
    .userpage-wrapper .radio-input { width: 20px; height: 20px; accent-color: #d4af37; }
    .userpage-wrapper .radio-label { color: #2c1810; font-size: 16px; cursor: pointer; }
    .userpage-wrapper .date-inputs { display: flex; gap: 10px; }
    .userpage-wrapper .date-select { padding: 8px 12px; border: 2px solid #d4af37; border-radius: 8px; font-size: 14px; background: white; min-width: 80px; transition: all 0.3s ease; }
    .userpage-wrapper .date-select:focus { border-color: #b8941f; outline: none; }
    .userpage-wrapper .profile-image-section { display: flex; flex-direction: column; align-items: center; gap: 15px; }
    .userpage-wrapper .profile-image { width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #d4af37, #b8941f); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; border: 4px solid white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); transition: all 0.3s ease; cursor: pointer; overflow: hidden; }
    .userpage-wrapper .profile-image:hover { transform: scale(1.05); box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3); }
    .userpage-wrapper .profile-image img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .userpage-wrapper .image-upload-btn { background: linear-gradient(135deg, #4ecdc4, #44b3a8); color: white; border: none; padding: 10px 20px; border-radius: 25px; cursor: pointer; font-size: 14px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3); }
    .userpage-wrapper .image-upload-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(78, 205, 196, 0.4); }
    .userpage-wrapper .image-info { font-size: 12px; color: #666; text-align: center; line-height: 1.4; }
    .userpage-wrapper .save-btn { background: #C49F7E; color: rgb(0, 0, 0); border: none; padding: 15px 40px; border-radius: 30px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 30px; transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3); }
    .userpage-wrapper .save-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4); }
    .userpage-wrapper .save-btn:active { transform: translateY(-1px); }
    .userpage-wrapper .hidden-input { display: none; }
    @media (max-width: 768px) {
        body {
            flex-direction: column;
        }
        .userpage-wrapper .sidebar {
            width: 100%;
            padding: 15px;
        }
        .userpage-wrapper .profile-form {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .userpage-wrapper .form-group {
            grid-template-columns: 1fr;
            gap: 10px;
        }
    }
    .userpage-wrapper .content-section {
        display: none;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }
    .userpage-wrapper .content-section.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
    .userpage-wrapper .password-form {
        display: grid;
        gap: 25px;
        max-width: 500px;
        margin: 0 auto;
        justify-items: center;
        width: 100%;
    }
    .userpage-wrapper .password-form .form-group {
        width: 100%;
    }
    .userpage-wrapper .password-form .form-input {
        width: 100%;
    }
    .userpage-wrapper .password-requirements {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #d4af37;
        margin-top: 20px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        text-align: left;
    }
    .userpage-wrapper .password-requirements h4 { margin-bottom: 10px; color: #2c1810; }
    .userpage-wrapper .password-requirements ul { margin-left: 20px; color: #666; }
    .userpage-wrapper .password-requirements li { margin-bottom: 5px; }
    .userpage-wrapper .password-requirements .save-btn {
        display: block;
        margin: 0 auto;
        width: 100%;
        max-width: 350px;
    }
    .userpage-wrapper .purchase-filters { display: flex; gap: 15px; margin-bottom: 30px; align-items: center; }
    .userpage-wrapper .filter-select, .userpage-wrapper .search-input { padding: 10px 15px; border: 2px solid #d4af37; border-radius: 8px; font-size: 14px; background: white; outline: none; }
    .userpage-wrapper .search-input { flex: 1; max-width: 300px; }
    .userpage-wrapper .purchase-list { display: grid; gap: 15px; }
    .userpage-wrapper .purchase-item { display: flex; align-items: center; justify-content: space-between; padding: 20px; background: white; border-radius: 10px; border-left: 4px solid #d4af37; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; }
    .userpage-wrapper .purchase-item:hover { transform: translateY(-2px); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); }
    .userpage-wrapper .purchase-info h4 { margin-bottom: 5px; color: #2c1810; }
    .userpage-wrapper .purchase-info p { margin-bottom: 3px; color: #666; font-size: 14px; }
    .userpage-wrapper .status { padding: 3px 8px; border-radius: 12px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
    .userpage-wrapper .status.completed { background: #d4edda; color: #155724; }
    .userpage-wrapper .status.pending { background: #fff3cd; color: #856404; }
    .userpage-wrapper .status.returned { background: #6f42c1; color: #fff; }
    .userpage-wrapper .purchase-amount { font-size: 18px; font-weight: 600; color: #d4af37; }
    .userpage-wrapper .view-details-btn { background: linear-gradient(135deg,rgb(168, 152, 122),rgb(186, 146, 72)); color: white; border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-size: 12px; transition: all 0.3s ease; }
    .userpage-wrapper .view-details-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3); }
    /* Purchase Tabs Redesign */
    .userpage-wrapper .purchase-tabs { display: flex; background: #FFDDAF; padding: 10px 10px 10px 10px; border-radius: 0 0 0 0; gap: 30px; margin-bottom: 20px; }
    .userpage-wrapper .purchase-tab { font-size: 18px; font-weight: 500; color: #23140c; background: none; border: none; outline: none; cursor: pointer; padding: 0 10px; transition: color 0.2s, font-weight 0.2s; }
    .userpage-wrapper .purchase-tab.active { font-weight: 700; color: #000; }
    .userpage-wrapper .purchase-tab-content { background: #FFDDAF; min-height: 180px; border-radius: 0 0 0 0; padding: 20px; }
    .userpage-wrapper .notification.show { transform: translateX(0); }
    .userpage-wrapper .dropdown-menu { z-index: 2000 !important; }

    /* My Purchases Order Cards */
    .userpage-wrapper .order-card { background: #fff; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.3s ease; }
    .userpage-wrapper .order-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
    .userpage-wrapper .order-header { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-bottom: 1px solid #eee; }
    .userpage-wrapper .order-id { font-weight: bold; color: #333; }
    .userpage-wrapper .order-status { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; color: #fff; }
    .userpage-wrapper .order-status.to-pay { background: #ffc107; }
    .userpage-wrapper .order-status.to-ship { background:rgb(82, 63, 37); }
    .userpage-wrapper .order-status.to-receive { background: rgb(126, 93, 47); }
    .userpage-wrapper .order-status.completed { background: #28a745; }
    .userpage-wrapper .order-status.cancelled { background: #dc3545; }
    .userpage-wrapper .order-status.returned { background: #6f42c1; }
    .userpage-wrapper .order-date { font-size: 14px; color: #777; }
    .userpage-wrapper .order-item { display: flex; align-items: center; gap: 15px; padding: 15px 20px; border-bottom: 1px solid #eee; }
    .userpage-wrapper .order-item:last-child { border-bottom: none; }
    .userpage-wrapper .order-item img { width: 60px; height: 60px; border-radius: 8px; object-fit: cover; }
    .userpage-wrapper .item-details { flex-grow: 1; }
    .userpage-wrapper .item-details div { font-weight: 500; color: #333; }
    .userpage-wrapper .item-details small { color: #888; }
    .userpage-wrapper .item-price { font-weight: bold; color: #333; }
    .userpage-wrapper .order-footer { display: flex; justify-content: flex-end; align-items: center; gap: 20px; padding: 15px 20px; background: #f9f9f9; border-top: 1px solid #eee; border-radius: 0 0 12px 12px; }
    .userpage-wrapper .total-price { font-size: 16px; font-weight: bold; color: #333; }
    .userpage-wrapper .total-price span { color:rgb(108, 82, 58); }
    .userpage-wrapper .btn-primary { background: #C49F7E; color: rgb(0, 0, 0); border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; transition: background 0.3s ease; }
    .userpage-wrapper .btn-primary:hover { background:rgb(98, 70, 45); color: white; }
    .userpage-wrapper .empty-state { text-align: center; padding: 40px; color: #888; }

    /* Modal Styles */
    .userpage-wrapper .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 2000; justify-content: center; align-items: center; }

    .userpage-wrapper .modal-content { background: #FFDDAF; border-radius: 12px; padding: 30px; max-width: 500px; width: 90%; box-shadow: 0 8px 32px rgba(0,0,0,0.3); }

    .userpage-wrapper .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #C49F7E; }

    .userpage-wrapper .modal-title { color: #8B4513; font-size: 20px; font-weight: bold; }

    .userpage-wrapper .close-modal { background: none; border: none; font-size: 24px; color: #8B4513; cursor: pointer; }

    .userpage-wrapper .modal-content .form-group { grid-template-columns: 1fr; gap: 10px; margin-bottom: 15px; }

    .userpage-wrapper .modal-buttons { display: flex; gap: 15px; margin-top: 25px; }

    .userpage-wrapper .btn-save, .userpage-wrapper .btn-cancel { flex: 1; border: none; border-radius: 6px; padding: 12px; font-size: 16px; font-weight: bold; cursor: pointer; }

    .userpage-wrapper .btn-save { background: #C49F7E; color: black; }
    .userpage-wrapper .btn-save:hover { background: rgb(98, 70, 45); color: white; }

    .userpage-wrapper .btn-cancel { background: #DDD; color: #333; }
    .userpage-wrapper .btn-cancel:hover { background: #BBB; }

    .userpage-wrapper .paid-indicator { font-size: 14px; font-weight: bold; color: #28a745; /* Green color for paid status */ background-color: #e9f7ef; padding: 8px 16px; border-radius: 6px; }

    @media (max-width: 1200px) {
        .userpage-wrapper .userpage-flex-container {
            flex-direction: column;
        }
        .userpage-wrapper .sidebar {
            width: 100%;
            min-width: 0;
            max-width: 100%;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 15px 10px;
            margin-bottom: 20px;
        }
        .userpage-wrapper .main-content {
            padding: 20px;
        }
    }
    @media (max-width: 900px) {
        .userpage-wrapper .profile-card {
            padding: 20px;
            max-width: 100%;
        }
        .userpage-wrapper .order-card {
            margin-bottom: 15px;
        }
        .userpage-wrapper .order-item img {
            width: 45px;
            height: 45px;
        }
        .userpage-wrapper .profile-image {
            width: 100px;
            height: 100px;
        }
        .userpage-wrapper .purchase-tabs {
            gap: 10px;
            flex-wrap: wrap;
        }
    }
    @media (max-width: 700px) {
        .userpage-wrapper .userpage-flex-container {
            flex-direction: column;
        }
        .userpage-wrapper .sidebar {
            width: 100%;
            min-width: 0;
            max-width: 100%;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 10px 5px;
            margin-bottom: 15px;
        }
        .userpage-wrapper .main-content {
            padding: 10px;
        }
        .userpage-wrapper .profile-card {
            padding: 10px;
        }
        .userpage-wrapper .form-label,
        .userpage-wrapper .radio-label {
            font-size: 14px;
        }
        .userpage-wrapper .form-input,
        .userpage-wrapper .date-select {
            font-size: 14px;
            padding: 8px 10px;
        }
        .userpage-wrapper .profile-title {
            font-size: 22px;
        }
        .userpage-wrapper .profile-image {
            width: 70px;
            height: 70px;
        }
        .userpage-wrapper .order-item img {
            width: 35px;
            height: 35px;
        }
        .userpage-wrapper .purchase-tabs {
            flex-direction: column;
            align-items: stretch;
            gap: 5px;
        }
        .userpage-wrapper .purchase-tab {
            width: 100%;
            text-align: center;
            margin: 0;
        }
        .userpage-wrapper .password-form {
            max-width: 100%;
            padding: 0 10px;
        }
        .userpage-wrapper .password-requirements {
            max-width: 100%;
            padding: 10px;
        }
        .userpage-wrapper .password-form .save-btn {
            max-width: 100%;
        }
    }
    @media (max-width: 500px) {
        .userpage-wrapper .userpage-flex-container {
            flex-direction: column;
        }
        .userpage-wrapper .sidebar {
            width: 100%;
            min-width: 0;
            max-width: 100%;
            flex-direction: column;
            padding: 5px 2px;
            margin-bottom: 10px;
        }
        .userpage-wrapper .main-content {
            padding: 5px;
        }
        .userpage-wrapper .profile-card {
            padding: 5px;
        }
        .userpage-wrapper .form-label,
        .userpage-wrapper .radio-label {
            font-size: 12px;
        }
        .userpage-wrapper .form-input,
        .userpage-wrapper .date-select {
            font-size: 12px;
            padding: 6px 6px;
        }
        .userpage-wrapper .profile-title {
            font-size: 16px;
        }
        .userpage-wrapper .profile-image {
            width: 50px;
            height: 50px;
        }
        .userpage-wrapper .order-item img {
            width: 25px;
            height: 25px;
        }
        .userpage-wrapper .purchase-tabs {
            flex-direction: column;
            align-items: stretch;
            gap: 2px;
        }
        .userpage-wrapper .purchase-tab {
            width: 100%;
            text-align: center;
            margin: 0;
        }
        .userpage-wrapper .order-card,
        .userpage-wrapper .purchase-tab-content {
            padding: 8px 2px;
        }
        .userpage-wrapper .order-header,
        .userpage-wrapper .order-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 8px 2px;
        }
        .userpage-wrapper .order-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            padding: 8px 2px;
        }
    }
    </style>
    <!-- Userpage content starts here -->
    <div class="dropdown-bar">
                <div class="nav-item dropdown-pet">
                    <a id="petTypeDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop by Pet
                    </a>
                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown5">
                        <a class="dropdown-item" href="{{ route('petpage', ['pet_type' => 'cat']) }}">
                            {{ __('Cat') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('petpage', ['pet_type' => 'dog']) }}">
                            {{ __('Dog') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('petpage', ['pet_type' => 'small_pet']) }}">
                            {{ __('Small Pet') }}
                        </a>
                    </div>
                </div>
    </div>

<div class="userpage-flex-container">
    <div class="sidebar">
        <div class="user-header">
            @php
                $user = auth()->user();
            @endphp
            @if($user)
                <div class="user-avatar" style="background:#fff;overflow:hidden;position:relative;">
                    @if($user->profile_image)
                        <img src="/{{ $user->profile_image }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;border-radius:50%;background:#fff;" onerror="this.style.display='none';this.parentNode.innerHTML='{{ strtoupper(substr($user->username ?? $user->name, 0, 1)) }}';" />
                    @else
                        {{ strtoupper(substr($user->username ?? $user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="user-info">
                    <h3>{{ $user->username ?? $user->name }}</h3>
                    <a href="#" class="edit-profile" id="editProfileLink">✏ Edit Profile</a>
                </div>
            @else
                <div class="user-avatar">?</div>
                <div class="user-info">
                    <h3>Guest</h3>
                    <a href="{{ route('login') }}" class="edit-profile">Login</a>
                </div>
            @endif
        </div>
        <div class="sidebar-section">
            <div class="sidebar-title">My Account</div>
            <div class="sidebar-item active" data-section="profile">
                <div class="nav-icon">👤</i></div>
                <span>Profile</span>
            </div>
            <div class="sidebar-item" data-section="password">
                <div class="sidebar-icon">🔒</div>
                <span>Change Password</span>
            </div>
            <div class="sidebar-item" data-section="purchase">
                <div class="sidebar-icon">🛒</div>
                <span>My Purchase</span>
            </div>
        </div>
    </div>
    <div class="main-content">
        <!-- Show success message -->
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="profile-card">
            <div class="profile-header">
                <h1 class="profile-title">My Account - Profile</h1>
                <div class="profile-divider"></div>
                <p class="profile-subtitle">Manage your personal information and account preferences</p>
            </div>
            <!-- Profile Section -->
            <div class="content-section active" id="profile-section">
                <form class="profile-form" id="profileForm" method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-fields">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-input" value="{{ old('username', $user->username ?? '') }}" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-input" value="{{ old('name', $user->name ?? '') }}" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" value="{{ old('email', $user->email ?? '') }}" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-input" value="{{ old('phonenumber', $user->phonenumber ?? '') }}" id="phonenumber" name="phonenumber">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <div class="gender-options">
                                <div class="radio-group">
                                    <input type="radio" class="radio-input" name="gender" value="male" id="male" {{ old('gender', $user->gender ?? null) === 'male' ? 'checked' : '' }}>
                                    <label class="radio-label" for="male">Male</label>
                                </div>
                                <div class="radio-group">
                                    <input type="radio" class="radio-input" name="gender" value="female" id="female" {{ old('gender', $user->gender ?? null) === 'female' ? 'checked' : '' }}>
                                    <label class="radio-label" for="female">Female</label>
                                </div>
                                <div class="radio-group">
                                    <input type="radio" class="radio-input" name="gender" value="other" id="other" {{ old('gender', $user->gender ?? null) === 'other' ? 'checked' : '' }}>
                                    <label class="radio-label" for="other">Other</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <div class="date-inputs">
                                <select class="date-select" id="day" name="day">
                                    <option value="">Day</option>
                                </select>
                                <select class="date-select" id="month" name="month">
                                    <option value="">Month</option>
                                </select>
                                <select class="date-select" id="year" name="year">
                                    <option value="">Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="profile-image-section">
                        <div class="profile-image" id="profileImage">
                            @if($user && $user->profile_image)
                                <img src="/{{ $user->profile_image }}" alt="Profile">
                            @else
                                👤
                            @endif
                        </div>
                        <button type="button" class="image-upload-btn" onclick="document.getElementById('imageInput').click()">
                            Select Image
                        </button>
                        <div class="image-info">
                            File extension: JPEG, PNG<br>
                            Max size: 2MB
                        </div>
                        <input type="file" class="hidden-input" id="imageInput" accept="image/jpeg,image/png" name="image">
                    </div>
                    <button class="save-btn" type="submit">Save Profile</button>
                </form>
            </div>
            <!-- Change Password Section -->
            <div class="content-section" id="password-section">
                @if (session('password_success'))
                    <div class="alert alert-success" style="margin-bottom: 20px;">
                        {{ session('password_success') }}
                    </div>
                @endif
                @if (session('password_error'))
                    <div class="alert alert-danger" style="margin-bottom: 20px;">
                        {{ session('password_error') }}
                    </div>
                @endif
                <form class="password-form" method="POST" action="{{ route('user.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-input" name="current_password" placeholder="Enter current password" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-input" name="new_password" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-input" name="new_password_confirmation" placeholder="Confirm new password" required>
                    </div>
                    <div class="password-requirements">
                        <h4>Password Requirements:</h4>
                        <ul>
                            <li>At least 8 characters long</li>
                            <li>Include uppercase and lowercase letters</li>
                            <li>Include at least one number</li>
                            <li>Include at least one special character</li>
                        </ul>
                    </div>
                    <button class="save-btn" type="submit">Update Password</button>
                </form>
            </div>
            <!-- My Purchase Section -->
            <div class="content-section" id="purchase-section">
                <div class="purchase-tabs nav nav-tabs" id="purchase-tabs-nav" role="tablist">
                    <button class="purchase-tab nav-link active" id="to-pay-tab" data-bs-toggle="tab" data-bs-target="#to-pay" type="button" role="tab" aria-controls="to-pay" aria-selected="true">To Pay</button>
                    <button class="purchase-tab nav-link" id="to-prepare-tab" data-bs-toggle="tab" data-bs-target="#to-prepare" type="button" role="tab" aria-controls="to-prepapre" aria-selected="false">Preparing</button>
                    <button class="purchase-tab nav-link" id="to-ship-tab" data-bs-toggle="tab" data-bs-target="#to-ship" type="button" role="tab" aria-controls="to-ship" aria-selected="false">To Ship</button>
                    <button class="purchase-tab nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                    <button class="purchase-tab nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</button>
                    <button class="purchase-tab nav-link" id="returned-tab" data-bs-toggle="tab" data-bs-target="#returned" type="button" role="tab" aria-controls="returned" aria-selected="false">Return</button>
                </div>
                <div class="tab-content" id="my-purchases-content">
                    <div class="tab-pane fade show active" id="to-pay" role="tabpanel" aria-labelledby="to-pay-tab">
                        @if($orders->where('status', 'pending')->count())
                            @foreach($orders->where('status', 'pending') as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">Order #{{ $order->id }}</span>
                                            <span class="order-status to-pay">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->image ?? 'assets/dog-img.png') }}" alt="{{ $item->product->name ?? '' }}">
                                            <div class="item-details">
                                                <div>{{ $item->product->name ?? 'Product not found' }}</div>
                                                <small>x{{ $item->quantity }}</small>
                                            </div>
                                            <div class="item-price">₱{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="order-footer">
                                        <div class="total-price">
                                            Order Total: <span>₱{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="paid-indicator">Paid via {{ $order->payment_method }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <p>No orders to pay.</p>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="to-prepare" role="tabpanel">
                        @php
                            $toShipOrders = $orders->filter(function($order) {
                                return in_array($order->status, ['preparing', 'placed']);
                            });
                        @endphp
                        @if($toShipOrders->count())
                            @foreach($toShipOrders as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">Order #{{ $order->id }}</span>
                                            <span class="order-status to-ship">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->image ?? 'assets/dog-img.png') }}" alt="{{ $item->product->name ?? '' }}">
                                            <div class="item-details">
                                                <div>{{ $item->product->name ?? 'Product not found' }}</div>
                                                <small>x{{ $item->quantity }}</small>
                                            </div>
                                            <div class="item-price">₱{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="order-footer">
                                        <div class="total-price">
                                            Order Total: <span>₱{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="paid-indicator">Paid via {{ $order->payment_method }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <p>No orders to ship.</p>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="to-ship" role="tabpanel">
                        @if($orders->where('status', 'shipping')->count())
                            @foreach($orders->where('status', 'shipping') as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">Order #{{ $order->id }}</span>
                                            <span class="order-status to-ship">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->image ?? 'assets/dog-img.png') }}" alt="{{ $item->product->name ?? '' }}">
                                            <div class="item-details">
                                                <div>{{ $item->product->name ?? 'Product not found' }}</div>
                                                <small>x{{ $item->quantity }}</small>
                                            </div>
                                            <div class="item-price">₱{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="order-footer">
                                        <div class="total-price">
                                            Order Total: <span>₱{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="paid-indicator">Paid via {{ $order->payment_method }}</span>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <p>No orders to ship.</p>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel">
                        @if($orders->where('status', 'delivered')->count())
                            @foreach($orders->where('status', 'delivered') as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">Order #{{ $order->id }}</span>
                                            <span class="order-status completed">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->image ?? 'assets/dog-img.png') }}" alt="{{ $item->product->name ?? '' }}">
                                            <div class="item-details">
                                                <div>{{ $item->product->name ?? 'Product not found' }}</div>
                                                <small>x{{ $item->quantity }}</small>
                                            </div>
                                            <div class="item-price">₱{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="order-footer">
                                        <div class="total-price">
                                            Order Total: <span>₱{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                        <button class="btn-primary">View</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <p>No completed orders.</p>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="cancelled" role="tabpanel">
                        @if($orders->where('status', 'cancelled')->count())
                            @foreach($orders->where('status', 'cancelled') as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">Order #{{ $order->id }}</span>
                                            <span class="order-status cancelled">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->image ?? 'assets/dog-img.png') }}" alt="{{ $item->product->name ?? '' }}">
                                            <div class="item-details">
                                                <div>{{ $item->product->name ?? 'Product not found' }}</div>
                                                <small>x{{ $item->quantity }}</small>
                                            </div>
                                            <div class="item-price">₱{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="order-footer">
                                        <div class="total-price">
                                            Order Total: <span>₱{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                        <button class="btn-primary">View</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <p>No cancelled orders.</p>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="returned" role="tabpanel">
                        @if($orders->where('status', 'returned')->count())
                            @foreach($orders->where('status', 'returned') as $order)
                                <div class="order-card">
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">Order #{{ $order->id }}</span>
                                            <span class="order-status returned">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ asset($item->product->image ?? 'assets/dog-img.png') }}" alt="{{ $item->product->name ?? '' }}">
                                            <div class="item-details">
                                                <div>{{ $item->product->name ?? 'Product not found' }}</div>
                                                <small>x{{ $item->quantity }}</small>
                                            </div>
                                            <div class="item-price">₱{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="order-footer">
                                        <div class="total-price">
                                            Order Total: <span>₱{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                        <button class="btn-primary">View</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <p>No returned orders.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- GCash Payment Modal -->
            <div class="modal-overlay" id="paymentModal" style="display:none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">GCash Payment</h2>
                        <button class="close-modal" onclick="closePaymentModal()">&times;</button>
                    </div>
                    <form id="paymentForm" method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label for="gcash_number" class="form-label" style="margin-bottom: 5px; display: block;">GCash Number:</label>
                            <input type="text" id="gcash_number" name="gcash_number" class="form-input" placeholder="09xxxxxxxxx" required>
                        </div>
                        <div class="modal-buttons">
                            <button type="submit" class="btn-save">Confirm Payment</button>
                            <button type="button" class="btn-cancel" onclick="closePaymentModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    // Initialize date selectors
    function initializeDateSelectors() {
        const daySelect = document.getElementById('day');
        const monthSelect = document.getElementById('month');
        const yearSelect = document.getElementById('year');
        // Populate days
        for (let i = 1; i <= 31; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            daySelect.appendChild(option);
        }
        // Populate months
        const months = ['January', 'February', 'March', 'April', 'May', 'June',
                       'July', 'August', 'September', 'October', 'November', 'December'];
        months.forEach((month, index) => {
            const option = document.createElement('option');
            option.value = index + 1;
            option.textContent = month;
            monthSelect.appendChild(option);
        });
        // Populate years
        const currentYear = new Date().getFullYear();
        for (let i = currentYear; i >= currentYear - 100; i--) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }
    }
    // Handle navigation with content switching
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.sidebar-item').forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            // Hide all content sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            // Show selected content section
            const section = this.getAttribute('data-section');
            const targetSection = document.getElementById(section + '-section');
            if (targetSection) {
                setTimeout(() => {
                    targetSection.classList.add('active');
                }, 100);
            }
            // Update page title and subtitle based on selection
            const titleElement = document.querySelector('.profile-title');
            const subtitleElement = document.querySelector('.profile-subtitle');
            switch(section) {
                case 'profile':
                    titleElement.textContent = 'My Account - Profile';
                    subtitleElement.textContent = 'Manage your personal information and account preferences';
                    break;
                case 'password':
                    titleElement.textContent = 'Change Password';
                    subtitleElement.textContent = 'Update your password to keep your account secure';
                    break;
                case 'purchase':
                    titleElement.textContent = 'My Purchase';
                    subtitleElement.textContent = 'View your order history and track current purchases';
                    break;
            }
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    // Additional functions for different sections
    function savePassword() {
        showNotification('Password updated successfully!', 'success');
    }
    function saveSettings() {
        showNotification('Settings saved successfully!', 'success');
    }
    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }
    // Add interactive functionality to purchase items
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-details-btn')) {
            const orderNumber = e.target.closest('.purchase-item').querySelector('h4').textContent;
            showNotification(`Viewing details for ${orderNumber}`, 'info');
        }
    });
    // Add functionality to settings toggles
    document.addEventListener('change', function(e) {
        if (e.target.type === 'checkbox' && e.target.closest('.toggle-switch')) {
            const settingName = e.target.closest('.setting-item').querySelector('h4').textContent;
            const status = e.target.checked ? 'enabled' : 'disabled';
            showNotification(`${settingName} ${status}`, 'info');
        }
    });
    // Handle image upload
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                return;
            }
            // Check file type
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                alert('Only JPEG and PNG files are allowed');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const profileImage = document.getElementById('profileImage');
                profileImage.innerHTML = `<img src="${e.target.result}" alt="Profile">`;
            };
            reader.readAsDataURL(file);
        }
    });
    // Handle form input animations
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = '';
        });
    });
    // Initialize everything when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initializeDateSelectors();
        // Add subtle entrance animation
        document.querySelector('.profile-card').style.opacity = '0';
        document.querySelector('.profile-card').style.transform = 'translateY(20px)';
        setTimeout(() => {
            document.querySelector('.profile-card').style.transition = 'all 0.6s ease';
            document.querySelector('.profile-card').style.opacity = '1';
            document.querySelector('.profile-card').style.transform = 'translateY(0)';
        }, 100);

        // If there are password errors, show the password section
        var hasPasswordError = false;
        @if ($errors->has('current_password') || $errors->has('new_password') || session('password_error'))
            hasPasswordError = true;
        @endif
        if (hasPasswordError) {
            // Remove active from all sidebar items and sections
            document.querySelectorAll('.sidebar-item').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
            // Activate password section
            document.querySelector('.sidebar-item[data-section="password"]').classList.add('active');
            document.getElementById('password-section').classList.add('active');
            // Update title and subtitle
            const titleElement = document.querySelector('.profile-title');
            const subtitleElement = document.querySelector('.profile-subtitle');
            titleElement.textContent = 'Change Password';
            subtitleElement.textContent = 'Update your password to keep your account secure';
        }

        @if(session('active_section'))
            const sectionToShow = '{{ session('active_section') }}';
            const purchaseTabToShow = '{{ session('active_purchase_tab') }}';

            // Deactivate all sidebar items and content sections
            document.querySelectorAll('.sidebar-item').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));

            // Activate the correct sidebar item and content section
            const sidebarItem = document.querySelector(`.sidebar-item[data-section="${sectionToShow}"]`);
            const sectionElement = document.getElementById(`${sectionToShow}-section`);
            if (sidebarItem && sectionElement) {
                sidebarItem.classList.add('active');
                sectionElement.classList.add('active');

                // Update titles
                const titleElement = document.querySelector('.profile-title');
                const subtitleElement = document.querySelector('.profile-subtitle');
                if (sectionToShow === 'purchase') {
                    titleElement.textContent = 'My Purchase';
                    subtitleElement.textContent = 'View your order history and track current purchases';
                }
            }
            
            if (sectionToShow === 'purchase' && purchaseTabToShow) {
                const triggerEl = document.querySelector(`#${purchaseTabToShow}-tab`);
                if (triggerEl) {
                    const tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            }
        @endif

        // Add event listener for Edit Profile link (moved inside DOMContentLoaded)
        document.getElementById('editProfileLink')?.addEventListener('click', function(e) {
            e.preventDefault();
            // Activate the Profile sidebar item
            document.querySelectorAll('.sidebar-item').forEach(nav => nav.classList.remove('active'));
            const profileSidebar = document.querySelector('.sidebar-item[data-section="profile"]');
            if (profileSidebar) profileSidebar.classList.add('active');
            // Hide all content sections
            document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
            // Show the profile section
            const profileSection = document.getElementById('profile-section');
            if (profileSection) profileSection.classList.add('active');
            // Update title and subtitle
            const titleElement = document.querySelector('.profile-title');
            const subtitleElement = document.querySelector('.profile-subtitle');
            if (titleElement) titleElement.textContent = 'My Account - Profile';
            if (subtitleElement) subtitleElement.textContent = 'Manage your personal information and account preferences';
            // Optionally scroll to the profile card
            document.querySelector('.profile-card')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            document.querySelector('.profile-form').submit();
        }
    });

    // Payment Modal Logic
    function openPaymentModal(orderId) {
        const modal = document.getElementById('paymentModal');
        const form = document.getElementById('paymentForm');
        form.action = `/order/${orderId}/pay`;
        modal.style.display = 'flex';
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').style.display = 'none';
    }

    document.querySelectorAll('.pay-now-btn').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.dataset.orderId;
            openPaymentModal(orderId);
        });
    });
</script>
  @include('components.footer')
@endsection
