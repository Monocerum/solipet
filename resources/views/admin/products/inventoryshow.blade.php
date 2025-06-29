@extends('admin.layout')

@section('title', 'View Product')

<style>
    .view-container {
        width: 100%;
        min-height: 80vh;
        background-color: #DAB08A;
        color: #2B1500;
    }

    .customer-card {
        background-color: #FAE3C2;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-section {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #F7D7AE;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #F59E0B;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #F59E0B;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        font-weight: bold;
        border: 4px solid #B45309;
    }

    .profile-info h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #2B1500;
    }

    .profile-info p {
        color: #6B5B4F;
        font-size: 1.1rem;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .detail-item {
        background-color: #F7D7AE;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid #F59E0B;
    }

    .detail-label {
        font-weight: 600;
        color: #2B1500;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        font-size: 1.1rem;
        color: #374151;
        word-wrap: break-word;
    }

    .detail-value.empty {
        color: #9CA3AF;
        font-style: italic;
    }

    .orders-section {
        background-color: #F7D7AE;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .orders-section h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #2B1500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .orders-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .stat-item {
        background-color: #FAE3C2;
        padding: 1rem;
        border-radius: 6px;
        text-align: center;
        min-width: 120px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #F59E0B;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #6B5B4F;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-back {
        background-color: #6B7280;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-back:hover {
        background-color: #4B5563;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #F59E0B;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        margin-left: 1rem;
    }

    .btn-edit:hover {
        background-color: #1E40AF;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .badge-male {
        background-color: #DBEAFE;
        color: #1E40AF;
    }

    .badge-female {
        background-color: #FCE7F3;
        color: #BE185D;
    }

    .badge-other {
        background-color: #F3E8FF;
        color: #7C3AED;
    }

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }

    .alert-error {
        background-color: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    @media (max-width: 768px) {
        .profile-section {
            flex-direction: column;
            text-align: center;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .orders-stats {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>

@section('content')
<div class="view-container rounded-lg p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">PRODUCT DETAILS</h1>
        <div>
            <a href="{{ route('admin.inventory') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Inventory
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">
                <i class="fas fa-edit"></i> Edit Products
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Customer Card -->
    <div class="customer-card">
        <!-- Profile Section -->
        <div class="profile-section">
            <div>
                @if($product->image && file_exists(public_path($product->image)))
                    <img src="{{ asset($product->image) }}" alt="Product Image" class="profile-image">
                @else
                    <div class="profile-placeholder">
                        {{ strtoupper(substr($product->name ?? 'P', 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="profile-info">
                <h2>{{ $product->name ?? 'No Name' }}</h2>
                <p><i class="fas fa-barcode"></i> Product ID: #{{ $product->id }}</p>
                <p><i class="fas fa-calendar-plus"></i> Added on: {{ $product->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="details-grid">
            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-heading"></i> Title</div>
                <div class="detail-value {{ !$product->title ? 'empty' : '' }}">
                    {{ $product->title ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-coins"></i> Price</div>
                <div class="detail-value">
                    ₱{{ number_format($product->price, 2) }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-boxes"></i> Stock</div>
                <div class="detail-value {{ $product->stock === 0 ? 'empty' : '' }}">
                    {{ $product->stock ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-industry"></i> Brand</div>
                <div class="detail-value {{ !$product->brand ? 'empty' : '' }}">
                    {{ $product->brand ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-star"></i> Ratings</div>
                <div class="detail-value {{ !$product->ratings ? 'empty' : '' }}">
                    {{ $product->ratings ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-comment"></i> Rating Text</div>
                <div class="detail-value {{ !$product->rating_text ? 'empty' : '' }}">
                    {{ $product->rating_text ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-tags"></i> Savings</div>
                <div class="detail-value {{ !$product->savings ? 'empty' : '' }}">
                    {{ $product->savings ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-list-ul"></i> Features</div>
                <div class="detail-value {{ !$product->features ? 'empty' : '' }}">
                    {{ $product->features ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-align-left"></i> Description</div>
                <div class="detail-value {{ !$product->description ? 'empty' : '' }}">
                    {{ $product->description ?? 'No description' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-cube"></i> Material</div>
                <div class="detail-value {{ !$product->material ? 'empty' : '' }}">
                    {{ $product->material ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-ruler-combined"></i> Dimensions</div>
                <div class="detail-value {{ !$product->dimensions ? 'empty' : '' }}">
                    {{ $product->dimensions ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-soap"></i> Care Instructions</div>
                <div class="detail-value {{ !$product->care_instructions ? 'empty' : '' }}">
                    {{ $product->care_instructions ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-list"></i> Category</div>
                <div class="detail-value">
                    {{ $product->category->name ?? 'Uncategorized' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-calendar-plus"></i> Created At</div>
                <div class="detail-value">
                    {{ $product->created_at->format('M d, Y \a\t g:i A') }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-clock"></i> Updated At</div>
                <div class="detail-value">
                    {{ $product->updated_at->format('M d, Y \a\t g:i A') }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-paw"></i> Pet Type</div>
                <div class="detail-value {{ !$product->pet_type ? 'empty' : '' }}">
                    {{ $product->pet_type ?? 'Not provided' }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection