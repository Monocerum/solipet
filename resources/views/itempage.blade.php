@extends('layouts.header') 

@section('content')
@section('title', $product->name . ' | Solipet')

<style>
.dropdown-bar {
    margin-bottom: 20px;
    display: flex;
    padding-left: 5%;
    border-radius: 6px;
}

.dropdown-bar > div {
    justify-content: flex-start;
    padding: 10px;
    display: flex;
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
    color: beige;
    font-family: 'Manrope', sans-serif;
    font-size: 1.25rem;
    font-weight: bold;
}

.dropdown-pet .dropdown-toggle:hover,
.dropdown-pet .dropdown-toggle:focus,
.dropdown-pet .dropdown-toggle:active {
    color: white;
    text-decoration: none;
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

.item-card {
    width: 200px;
    background: linear-gradient(135deg, #f4d4b8, #e8c4a0);
    border: 4px solid #8b4513;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    overflow: hidden;
    position: relative;
}

.item-image {
    width: 100%;
    height: 180px;
    background-color: #4a2c2a;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.item-info {
    padding: 12px;
    background-color: #f4d4b8;
}

.item-name {
    font-size: 18px;
    font-weight: bold;
    color: #2c1810;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.item-price {
    background: linear-gradient(90deg, #4a2c2a 0%,rgb(236, 189, 156) 100%);
    color: #f4d4b8;
    padding: 4px 8px;
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 8px;
    display: inline-block;
    width: 100%;
}

.item-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 10px;
    color: #4a2c2a;
}

.discount {
    font-weight: bold;
}

.rating {
    margin-left: 20px;
    display: flex;
    align-items: center;
    gap: 2px;
}

.star {
    color: #000000;
}

.sold-count {
    margin-left: 30px;
    font-size: 9px;
}

.cat-img {
    position: absolute; 
    left: 0; 
    bottom: 0; 
    width: 100px; 
    height: auto; 
    z-index: 2; 
    margin-left: -7px;
    margin-bottom: -4px;
    pointer-events: none;
}


 /* Main Content */
        .main-content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-container {
            background-color: #F2D5BC;
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .product-image {
            background-color: #2E160C;
            height: 80vh;
            width: 70vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .pixel-cat {
            position: absolute;
            left: 15%;
            bottom: 0;
            transform: translateX(-50%);
            width: 60%;
            display: flex;
            justify-content: center;
        }

        .cat-face {
            position: relative;
            transform: none;
            font-size: 20px;
        }

        .cat-face img {
            width: 200%;
            max-width: 500px;
            max-height: 40vh;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 10%;
        }

         .product-title {
            font-size: 40px;
            font-weight: bold;
            color: #000000;
            margin-bottom: 10px;
        }

        .price-rating-row {
            display: flex;
            align-items: center;
            gap: 50px;
            margin-bottom: 15px;
        }

        .price-container {
            background-image: url("{{ asset('assets/price-bg.png') }}");
            background-repeat: no-repeat;
            width: 50%;
            color: #ffffff;
            padding: 8px 16px;
            font-size: 30px;
            font-weight: bold;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
        }

        .stars {
            color: #000000;
            font-size:30px;
            white-space: nowrap;
        }

        .rating-text {
            font-size: 12px;
            color: #000000;
            white-space: nowrap;
        }

        .savings {
            color: #000000;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .stock-indicator {
            margin-bottom: 15px;
        }

        .stock-available {
            color: #008000;
            font-weight: bold;
        }

        .stock-unavailable {
            color: #ff0000;
            font-weight: bold;
        }

        .features {
            list-style: none;
            margin-bottom: 30px;
        }

        .features li {
            color: #000000;
            margin-bottom: 5px;
            position: relative;
            padding-left: 15px;
        }

        .features li::before {
            content: "•";
            color: #000000;
            position: absolute;
            left: 0;
        }

        .action-buttons {
            display: flex;
            gap: 24px;
            align-items: stretch;
        }
        .action-buttons > * {
            flex: 1 1 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: stretch;
        }
        .item-btn {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 14px;
            font-size: 1.25rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 12px 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .item-btn-primary {
            background-color: #F5E6D3;
            color: #341B10;
            border: 4px solid #341B10;
            margin-top: 0;
        }
        .item-btn-primary:hover,
        .item-btn-secondary:hover {
            background-color: #341B10;
            color: #F5E6D3;
            border: 4px solid #341B10;
        }
        .item-btn-secondary {
            background-color: #F5E6D3;
            color: #341B10;
            border: 4px solid #341B10;
            margin-top: 0;
        }

        /* Out of Stock Styles */
        .item-btn-disabled {
            background-color: #cccccc !important;
            color:rgb(79, 57, 30) !important;
            border: 4px solid rgb(79, 57, 30) !important;
            cursor: not-allowed !important;
        }

        .item-btn-disabled:hover {
            background-color: #cccccc !important;
            color: rgb(79, 57, 30) !important;
            border: 4px solid rgb(79, 57, 30) !important;
        }

        .out-of-stock-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .stock-status {
            color: #ff0000;
            font-weight: bold;
            font-size: 14px;
            margin: 0;
            text-align: center;
        }

        /* Tab Navigation */
        .tab-nav {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 20px solid #F5E6D3
        }

        .tab-btn {
            background-color: #DCB47C;
            border: none;
            padding: 20px 50px;
            font-size: 16px;
            font-weight: bold;
            color: #4A2C17;
            cursor: pointer;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background-color: #F2D5BC;
            color: #000000;
        }

        .tab-btn:hover {
            background-color: #8B4513;
            color: #F5E6D3;
        }

        /* Product Details */
        .product-details {
            background-color: #2E160C;
            padding: 30px;
            border-radius: 0 10px 10px 10px;
            color: #ffffff;
            line-height: 1.6;
        }

        .detail-section {
            margin-bottom: 20px;
        }

        .detail-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #ffffff;
        }

        /* Review Form Styles */
        .review-form {
            background-color: #4A2C17;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 2px solid #8B4513;
        }

        .review-form h4 {
            color: #F5E6D3;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #F5E6D3;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #8B4513;
            border-radius: 6px;
            background-color: #F5E6D3;
            color: #2E160C;
            font-family: 'Manrope', sans-serif;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #DCB47C;
            box-shadow: 0 0 5px rgba(220, 180, 124, 0.5);
        }

        .submit-review-btn {
            background-color: #DCB47C;
            color: #2E160C;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-review-btn:hover {
            background-color: #8B4513;
            color: #F5E6D3;
        }

        .success-message {
            background-color: #4A2C17;
            color: #90EE90;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #90EE90;
        }

        .error-message {
            background-color: #4A2C17;
            color: #FFB6C1;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #FFB6C1;
        }

        /* Stock Error Popup Modal */
        .stock-error-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .stock-error-modal.show {
            display: flex;
        }

        .stock-error-content {
            background: linear-gradient(135deg, #F2D5BC, #E8C4A0);
            border: 4px solid #8B4513;
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .stock-error-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #8B4513;
        }

        .stock-error-title {
            color: #8B4513;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            font-family: 'Manrope', sans-serif;
        }

        .stock-error-message {
            color: #4A2C17;
            font-size: 16px;
            line-height: 1.4;
            margin-bottom: 20px;
            font-family: 'Manrope', sans-serif;
        }

        .stock-error-close {
            background: linear-gradient(135deg, #8B4513, #A0522D);
            color: #F2D5BC;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Manrope', sans-serif;
        }

        .stock-error-close:hover {
            background: linear-gradient(135deg, #A0522D, #CD853F);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
        }

        .stock-error-close:active {
            transform: translateY(0);
        }

@media (max-width: 1024px) {
    .main-content {
        padding: 20px 5px;
        max-width: 100%;
    }
    .product-container {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 20px;
    }
    .product-image {
        height: 40vh;
        width: 100%;
    }
    .pixel-cat {
        width: 70%;
        left: 20%;
    }
    .cat-face img {
        max-width: 220px;
        max-height: 20vh;
    }
    .product-info {
        margin-top: 0;
    }
    .price-container {
        width: 80%;
        font-size: 22px;
    }
    .product-title {
        font-size: 28px;
    }
    .tab-btn {
        padding: 12px 20px;
        font-size: 14px;
    }
}
@media (max-width: 768px) {
    .dropdown-bar {
        flex-direction: column;
        gap: 8px;
        padding: 8px;
    }
    .dropdown-bar > div {
        flex-direction: column;
        gap: 10px;
        height: auto;
    }
    .dropdown-pet, .dropdown-pet1 {
        width: 100%;
    }
    .main-content {
        padding: 10px 2px;
    }
    .product-container {
        grid-template-columns: 1fr;
        gap: 10px;
        padding: 10px;
    }
    .product-image {
        height: 30vh;
    }
    .pixel-cat {
        width: 80%;
        left: 25%;
    }
    .cat-face img {
        max-width: 160px;
        max-height: 15vh;
    }
    .product-title {
        font-size: 20px;
    }
    .price-container {
        font-size: 16px;
        width: 100%;
        padding: 6px 8px;
    }
    .rating {
        gap: 5px;
    }
    .stars {
        font-size: 18px;
    }
    .action-buttons {
        flex-direction: column;
        gap: 12px;
    }
    .item-btn {
        width: 100%;
        font-size: 14px;
        padding: 10px 0;
    }
    .tab-nav {
        flex-direction: column;
        gap: 5px;
        border-bottom-width: 10px;
    }
    .tab-btn {
        width: 100%;
        padding: 10px 0;
        font-size: 13px;
    }
    .product-details {
        padding: 15px;
        font-size: 14px;
    }
    .review-form {
        padding: 15px;
    }
    .review-form h4 {
        font-size: 16px;
    }
    .form-group input,
    .form-group textarea {
        padding: 8px;
        font-size: 14px;
    }
    .submit-review-btn {
        padding: 10px 20px;
        font-size: 14px;
    }
}
@media (max-width: 480px) {
    .main-content {
        padding: 2px;
    }
    .product-container {
        padding: 5px;
        gap: 5px;
    }
    .product-title {
        font-size: 16px;
    }
    .price-container {
        font-size: 12px;
        padding: 4px 4px;
    }
    .stars {
        font-size: 14px;
    }
    .rating-text {
        font-size: 10px;
    }
    .features li {
        font-size: 12px;
    }
    .item-btn {
        font-size: 12px;
        padding: 8px 0;
    }
    .tab-btn {
        font-size: 11px;
        padding: 8px 0;
    }
    .product-details {
        font-size: 12px;
        padding: 8px;
    }
    .review-form {
        padding: 10px;
    }
    .review-form h4 {
        font-size: 14px;
    }
    .form-group input,
    .form-group textarea {
        padding: 6px;
        font-size: 12px;
    }
    .submit-review-btn {
        padding: 8px 16px;
        font-size: 12px;
    }
}

</style>
@if (!isset($product))
    <p>Product not found.</p>
    @php return; @endphp
@endif
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
   
    <main class="main-content">
        <div class="product-container">
            <div class="product-image"> 
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;border: 10px solid #2E160C; border-radius: 8px;" />
                @else
                    <img src="{{ asset('assets/cat-img.png') }}" alt="No Image" style="width:100%;height:100%;object-fit:cover;border: 10px solid #2E160C; border-radius: 8px;" />
                @endif
            </div>   
            <div class="product-info">
                <h1 class="product-name">{{ $product->name }}</h1>
                 <div class="price-rating-row">
                    <div class="price-container">PHP {{ number_format($product->price, 2) }}</div>
                    <div class="rating">
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($product->ratings))
                                    ★
                                @elseif ($i - $product->ratings < 1)
                                    ☆
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <div class="rating-text">{{ $product->rating_text }}</div>
                    </div>
                </div>
                <div class="savings">{{ $product->savings }}</div>
                
                <div class="stock-indicator">
                    @if($product->stock > 0)
                        <span class="stock-available">In Stock: {{ $product->stock }} available</span>
                    @else
                        <span class="stock-unavailable">Out of Stock</span>
                    @endif
                </div>
                
                <ul class="features">
                    @foreach($product->features ?? [] as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
                
                <div class="action-buttons">
                    @if($product->stock > 0)
                        <form method="POST" action="{{ route('buy.now') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="item-btn item-btn-primary">BUY NOW</button>
                        </form>
                        <form method="POST" action="{{ route('add.to.cart') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="item-btn item-btn-secondary">ADD TO CART</button>
                        </form>
                    @else
                        <div class="out-of-stock-container">
                            <button class="item-btn item-btn-disabled" disabled>OUT OF STOCK</button>
                            <p class="stock-status">This item is currently unavailable</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-nav">
            <button class="tab-btn active" id="info-tab" onclick="showTab('info')">MORE INFO</button>
            <button class="tab-btn" id="reviews-tab" onclick="showTab('reviews')">REVIEWS</button>
        </div>

        <!-- Product Details / Reviews -->
        <div id="info-section" class="product-details">
            <p>{{ $product->description }}</p>
            <div class="detail-section">
                <div class="detail-title">Material:</div>
                <p>{{ $product->material }}</p>
            </div>
            <div class="detail-section">
                <div class="detail-title">Product Dimensions:</div>
                <p>{{ $product->dimensions }}</p>
            </div>
            <div class="detail-section">
                <div class="detail-title">Care Instructions:</div>
                <p>{{ $product->care_instructions }}</p>
            </div>
        </div>
        <div id="reviews-section" class="product-details" style="display:none;">
            <h3>Reviews</h3>
            
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Review Submission Form -->
            <div class="review-form">
                <h4>Write a Review</h4>
                <form method="POST" action="{{ route('submit.review') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="form-group">
                        <label for="reviewer_name">Your Name:</label>
                        <input type="text" id="reviewer_name" name="reviewer_name" value="{{ old('reviewer_name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="review_text">Your Review:</label>
                        <textarea id="review_text" name="review_text" placeholder="Share your experience with this product..." required>{{ old('review_text') }}</textarea>
                    </div>
                    
                    <button type="submit" class="submit-review-btn">Submit Review</button>
                </form>
            </div>

            <!-- Existing Reviews -->
            @if(isset($reviews) && $reviews && count($reviews))
                @foreach($reviews as $review)
                    <div class="detail-section">
                        <div class="detail-title">{{ $review->reviewer_name }}</div>
                        <p>{{ $review->review_text }}</p>
                    </div>
                @endforeach 
            @else
                <p>No reviews yet.</p>
            @endif
        </div>
    </main>

    <!-- Stock Error Popup Modal -->
    <div class="stock-error-modal" id="stockErrorModal">
        <div class="stock-error-content">
            <div class="stock-error-icon">⚠️</div>
            <div class="stock-error-title">Stock Limit Exceeded</div>
            <div class="stock-error-message" id="stockErrorMessage">
                Requested quantity exceeds available stock. Only <span id="availableStock">0</span> items available.
            </div>
            <button class="stock-error-close" onclick="closeStockErrorModal()">Got it!</button>
        </div>
    </div>

    @include('components.footer')
@endsection
<script>
function showTab(tab) {
    document.getElementById('info-section').style.display = (tab === 'info') ? 'block' : 'none';
    document.getElementById('reviews-section').style.display = (tab === 'reviews') ? 'block' : 'none';
    document.getElementById('info-tab').classList.toggle('active', tab === 'info');
    document.getElementById('reviews-tab').classList.toggle('active', tab === 'reviews');
}

// Stock Error Modal Functions
function showStockErrorModal(message, availableStock) {
    const modal = document.getElementById('stockErrorModal');
    const messageElement = document.getElementById('stockErrorMessage');
    const stockElement = document.getElementById('availableStock');
    
    if (message) {
        messageElement.innerHTML = message;
    }
    
    if (availableStock !== undefined) {
        stockElement.textContent = availableStock;
    }
    
    modal.classList.add('show');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        closeStockErrorModal();
    }, 5000);
}

function closeStockErrorModal() {
    const modal = document.getElementById('stockErrorModal');
    modal.classList.remove('show');
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('stockErrorModal');
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeStockErrorModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeStockErrorModal();
        }
    });
});

// Check for stock error messages on page load
document.addEventListener('DOMContentLoaded', function() {
    @if(session('error'))
        const errorMessage = "{{ session('error') }}";
        if (errorMessage.includes('stock') || errorMessage.includes('Stock')) {
            // Extract stock number if available
            const stockMatch = errorMessage.match(/(\d+)/);
            const availableStock = stockMatch ? stockMatch[1] : '0';
            showStockErrorModal(errorMessage, availableStock);
        }
    @endif
});
</script>
