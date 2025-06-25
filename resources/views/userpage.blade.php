@extends('layouts.header') 

@section('content')
<style>
.dropdown-bar {
    margin-bottom: 20px;
    display: flex;
    gap: 15px;
    background-color: beige;
    padding: 10px;
    border-radius: 6px;
    position: relative;
    z-index: 100;
}
.dropdown-bar > div {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    gap: 30px;
    height: 50px;
}
.dropdown-pet {
    position: relative;
    width: 200px;
}
.dropdown-pet1 {
    position: relative;
    width: 300px;
}
.dropdown-pet .dropdown-toggle, .dropdown-pet1 .dropdown-toggle {
    color: #000000;
    font-family: 'Manrope', sans-serif;
    font-size: 1.25rem;
    font-weight: bold;
}
.hero-section {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: -20px;
    margin-bottom: 30px;
}
.sidebar-catalog {
    color: beige;
    font-family: 'Manrope', sans-serif;
    margin-left: 20px;
}
.sidebar-catalog h4,
.sidebar-catalog h5,
.sidebar-catalog label,
.sidebar-catalog a {
    color: #f2d5bc;
}
.sidebar-catalog h5 {
    background-color: #2E160C;
    color: #f2d5bc;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.userpage-flex-container {
    display: flex;
    min-height: 100vh;
    background: linear-gradient(135deg, #2c1810, #4a2c1a);
    position: relative;
    z-index: 1;
}
.sidebar {
    width: 300px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    z-index: 2;
    position: relative;
}
.user-header {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}
.user-header:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}
.user-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    font-weight: bold;
}
.user-info h3 {
    color: #f4f1eb;
    font-size: 18px;
    margin-bottom: 5px;
}
.edit-profile {
    color: #d4af37;
    font-size: 12px;
    text-decoration: none;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}
.edit-profile:hover {
    opacity: 1;
}
.sidebar-section {
    margin-bottom: 30px;
}
.sidebar-title {
    color: #d4af37;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0 20px 15px 20px;
    border-bottom: 1px solid rgba(212, 175, 55, 0.3);
    margin-bottom: 15px;
}
.sidebar-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 20px;
    color: #f4f1eb;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-bottom: 5px;
    margin-left: 10px;
    border-left: 3px solid transparent;
}
.sidebar-item:hover, .sidebar-item.active {
    background: #372215;
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    border-left-color: #f4f1eb;
}
.nav-icon img{
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.main-content {
    flex: 1;
    padding: 40px;
    overflow-y: auto;
    z-index: 2;
    position: relative;
}
.profile-card {
    background: #FFDDAF;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
}
.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background-size: 200% 100%;
    animation: shimmer 3s ease-in-out infinite;
}
@keyframes shimmer {
    0%, 100% { background-position: 200% 0; }
    50% { background-position: -200% 0; }
}
.profile-header {
    text-align: center;
    margin-bottom: 40px;
}
.profile-subtitle {
    color: #666;
    font-size: 16px;
    margin-top: 15px;
    font-weight: 300;
}
.profile-title {
    font-size: 32px;
    color: #2c1810;
    margin-bottom: 10px;
    font-weight: 300;
}
.profile-divider {
    width: 100px;
    height: 2px;
    background: linear-gradient(90deg, #d4af37, #b8941f);
    margin: 0 auto;
}
.profile-form {
    display: grid;
    grid-template-columns: 1fr 200px;
    gap: 40px;
    align-items: start;
}
.form-fields {
    display: grid;
    gap: 25px;
}
.form-group {
    display: grid;
    grid-template-columns: 150px 1fr;
    gap: 20px;
    align-items: center;
}
.form-label {
    font-weight: 600;
    color: #2c1810;
    font-size: 16px;
}
.form-input {
    padding: 12px 16px;
    border: 2px solid #d4af37;
    border-radius: 10px;
    font-size: 16px;
    background: white;
    transition: all 0.3s ease;
    outline: none;
}
.form-input:focus {
    border-color: #b8941f;
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    transform: translateY(-1px);
}
.gender-options {
    display: flex;
    gap: 20px;
    align-items: center;
}
.radio-group {
    display: flex;
    align-items: center;
    gap: 8px;
}
.radio-input {
    width: 20px;
    height: 20px;
    accent-color: #d4af37;
}
.radio-label {
    color: #2c1810;
    font-size: 16px;
    cursor: pointer;
}
.date-inputs {
    display: flex;
    gap: 10px;
}
.date-select {
    padding: 8px 12px;
    border: 2px solid #d4af37;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    min-width: 80px;
    transition: all 0.3s ease;
}
.date-select:focus {
    border-color: #b8941f;
    outline: none;
}
.profile-image-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}
.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, #d4af37, #b8941f);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 48px;
    border: 4px solid white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    cursor: pointer;
    overflow: hidden;
}
.profile-image:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}
.profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
.image-upload-btn {
    background: linear-gradient(135deg, #4ecdc4, #44b3a8);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
}
.image-upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(78, 205, 196, 0.4);
}
.image-info {
    font-size: 12px;
    color: #666;
    text-align: center;
    line-height: 1.4;
}
.save-btn {
    background: #C49F7E;
    color: rgb(0, 0, 0);
    border: none;
    padding: 15px 40px;
    border-radius: 30px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 30px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
}
.save-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
}
.save-btn:active {
    transform: translateY(-1px);
}
.hidden-input {
    display: none;
}
@media (max-width: 768px) {
    body {
        flex-direction: column;
    }
    .sidebar {
        width: 100%;
        padding: 15px;
    }
    .profile-form {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .form-group {
        grid-template-columns: 1fr;
        gap: 10px;
    }
}
.content-section {
    display: none;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
}
.content-section.active {
    display: block;
    opacity: 1;
    transform: translateY(0);
}
.password-form {
    display: grid;
    gap: 25px;
    max-width: 500px;
}
.password-requirements {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #d4af37;
    margin-top: 20px;
}
.password-requirements h4 {
    margin-bottom: 10px;
    color: #2c1810;
}
.password-requirements ul {
    margin-left: 20px;
    color: #666;
}
.password-requirements li {
    margin-bottom: 5px;
}
.purchase-filters {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
    align-items: center;
}
.filter-select, .search-input {
    padding: 10px 15px;
    border: 2px solid #d4af37;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    outline: none;
}
.search-input {
    flex: 1;
    max-width: 300px;
}
.purchase-list {
    display: grid;
    gap: 15px;
}
.purchase-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background: white;
    border-radius: 10px;
    border-left: 4px solid #d4af37;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}
.purchase-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}
.purchase-info h4 {
    margin-bottom: 5px;
    color: #2c1810;
}
.purchase-info p {
    margin-bottom: 3px;
    color: #666;
    font-size: 14px;
}
.status {
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}
.status.completed {
    background: #d4edda;
    color: #155724;
}
.status.pending {
    background: #fff3cd;
    color: #856404;
}
.purchase-amount {
    font-size: 18px;
    font-weight: 600;
    color: #d4af37;
}
.view-details-btn {
    background: linear-gradient(135deg, #4ecdc4, #44b3a8);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.3s ease;
}
.view-details-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
}
/* Purchase Tabs Redesign */
.purchase-tabs {
    display: flex;
    background: #FFDDAF;
    padding: 10px 10px 10px 10px;
    border-radius: 0 0 0 0;
    gap: 30px;
    margin-bottom: 20px;
}
.purchase-tab {
    font-size: 18px;
    font-weight: 500;
    color: #23140c;
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 0 10px;
    transition: color 0.2s, font-weight 0.2s;
}
.purchase-tab.active {
    font-weight: 700;
    color: #000;
}
.purchase-tab-content {
    background: #FFDDAF;
    min-height: 180px;
    border-radius: 0 0 0 0;
    padding: 20px;
}
.notification.show {
    transform: translateX(0);
}
.dropdown-menu {
    z-index: 2000 !important;
}
</style>
<div class="dropdown-bar">
    <div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pet Food
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                {{-- TODO: Replace route to proper name and file --}}
                <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Dry Food') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Wet Food') }}
                </a>
            </div>
        </div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pet Treats
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown2">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Snacks') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Dental Treats') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Training Treats') }}
                </a>
            </div>
        </div>
        <div class="nav-item dropdown-pet1">
            <a id="navbarDropdown3" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pet Health & Wellness
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown3">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Multivitamins & Supplements') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Skin and Coat Treatment') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Tick & Flea/Parasite Prevention') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Special Needs') }}
                </a>
            </div>
        </div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown4" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pet Supplies
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown4">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Apparel') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Beds') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Bowls and Feeders') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Leashes and Harnesses') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Crates, Kernels, & Outdoors') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Toys') }}
                </a>
            </div>
        </div>
        <div class="nav-item dropdown-pet">
            <a id="navbarDropdown5" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pet Type
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown5">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Cat') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Dog') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Small Pet') }}
                </a>
            </div>
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
                    <a href="#" class="edit-profile">✏ Edit Profile</a>
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
                <div class="nav-icon"><img src="user-icon.png" alt="user icon"> </i></div>
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
                <div class="purchase-tabs">
                    <div class="purchase-tab active">To Pay</div>
                    <div class="purchase-tab">To Ship</div>
                    <div class="purchase-tab">To Receive</div>
                    <div class="purchase-tab">Completed</div>
                    <div class="purchase-tab">Cancelled</div>
                    <div class="purchase-tab">Return</div>
                </div>
                <div class="purchase-tab-content"></div>
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
    });
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            document.querySelector('.profile-form').submit();
        }
    });
</script>
@endsection
