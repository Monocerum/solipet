@extends('admin.layout')

@section('title', 'Edit Customer')

<style>
    .form-container {
        background-color: #DAB08A;
        min-height: 80vh;
        padding: 2rem;
        border-radius: 12px;
    }

    .form-card {
        background-color: #FAE3C2;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #2B1500;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #E5D3B3;
        border-radius: 8px;
        background-color: white;
        color: #2B1500;
        font-size: 0.875rem;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #F59E0B;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #E5D3B3;
        border-radius: 8px;
        background-color: white;
        color: #2B1500;
        font-size: 0.875rem;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #F59E0B;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .btn-primary:hover {
        background-color: #B45309;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6B7280;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-block;
        margin-right: 1rem;
    }

    .btn-secondary:hover {
        background-color: #4B5563;
    }

    .error-message {
        color: #DC2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .alert-error {
        background-color: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .grid-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

@section('content')
<div class="form-container">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#2B1500]">Edit Customer</h1>
        <p class="text-[#2B1500] opacity-75">Update customer information</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid-2">
                <div class="form-group">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input" 
                           value="{{ old('name', $customer->name) }}" 
                           required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">Username *</label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           class="form-input" 
                           value="{{ old('username', $customer->username) }}" 
                           required>
                    @error('username')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="form-input" 
                       value="{{ old('email', $customer->email) }}" 
                       required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label for="phonenumber" class="form-label">Phone Number</label>
                    <input type="text" 
                           id="phonenumber" 
                           name="phonenumber" 
                           class="form-input" 
                           value="{{ old('phonenumber', $customer->phonenumber) }}" 
                           placeholder="e.g., +63 917 123 4567">
                    @error('phonenumber')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $customer->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $customer->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $customer->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" 
                       id="dob" 
                       name="dob" 
                       class="form-input" 
                       value="{{ old('dob', $customer->dob) }}" 
                       max="{{ date('Y-m-d') }}">
                @error('dob')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.customers') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>Update Customer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection