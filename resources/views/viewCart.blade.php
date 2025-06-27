@extends('layouts.header') 

@section('content')
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
 .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product-section {
            flex: 1;
            min-width: 300px;
            background: #F5DEB3;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #8B4513;
            font-size: 16px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #DDD;
        }

        .product-image {
            width: 60px;
            height: 60px;
            background: #8B4513;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            text-align: center;
            line-height: 1.2;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .product-price {
            color: #8B4513;
            font-size: 12px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: none;
            background: #8B4513;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: #654321;
        }

        .quantity-display {
            background: #8B4513;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            min-width: 40px;
            text-align: center;
        }

        .item-total {
            font-weight: bold;
            color: #8B4513;
            font-size: 16px;
        }

        .summary-section {
            width: 300px;
            background: #F5DEB3;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            height: fit-content;
        }

        .total-amount {
            text-align: center;
            margin-bottom: 20px;
        }

        .total-label {
            color: #8B4513;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #8B4513;
        }

        .order-instruction {
            margin-bottom: 20px;
        }

        .order-instruction select {
            width: 100%;
            padding: 10px;
            border: 1px solid #DDD;
            border-radius: 6px;
            background: white;
            color: #333;
            font-size: 14px;
        }

        .delivery-options {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .delivery-option {
            flex: 1;
            background: #8B4513;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 10px;
            cursor: pointer;
            text-align: center;
            font-size: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .delivery-option:hover {
            background: #654321;
        }

        .delivery-option.active {
            background: #654321;
        }

        .delivery-icon {
            font-size: 20px;
        }

        
        .delivery-icon img, .shipping-icon img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }
        
        .checkout-note {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-bottom: 15px;
        }

        .checkout-btn {
            width: 100%;
            background: #8B4513;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            background: #654321;
        }

        .shipping-section {
            max-width: 1200px;
            margin: 20px auto 0;
            background: #F5DEB3;
            border-radius: 12px;
            padding: 15px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }

        .shipping-icon {
            font-size: 20px;
            color: #8B4513;
        }

        .shipping-text {
            color: #8B4513;
            font-weight: bold;
            font-size: 14px;
        }

        .dropdown-arrow {
            margin-left: auto;
            color: #8B4513;
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .dropdown-arrow.open {
            transform: rotate(180deg);
        }

        .shipping-address-content {
            max-width: 1200px;
            margin: 0 auto;
            background: #F5DEB3;
            border-radius: 0 0 12px 12px;
            padding: 20px;
            margin-top: -12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            display: none;
        }

        .shipping-address-content.show {
            display: block;
        }

        .address-text {
            color: #8B4513;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .edit-address-btn {
            background: #8B4513;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 12px;
            cursor: pointer;
        }

        .edit-address-btn:hover {
            background: #654321;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-content {
            background: #F5DEB3;
            border-radius: 12px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #8B4513;
        }

        .modal-title {
            color: #8B4513;
            font-size: 20px;
            font-weight: bold;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            color: #8B4513;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-modal:hover {
            color: #654321;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #8B4513;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid #DDD;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            background: white;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #8B4513;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-save {
            flex: 1;
            background: #8B4513;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #654321;
        }

        .btn-cancel {
            flex: 1;
            background: #DDD;
            color: #333;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #BBB;
        }

        @media (max-width: 768px) {
            .checkout-container {
                flex-direction: column;
            }
            
            .summary-section {
                width: 100%;
            }
            
            .delivery-options {
                flex-direction: column;
            }
        }
        @media (max-width: 600px) {
        .checkout-container {
            flex-direction: column;
            gap: 10px;
            padding: 0 4px;
        }
        .product-section, .summary-section {
            min-width: 0;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .product-header, .product-item {
            font-size: 12px;
            gap: 6px;
            padding: 8px 0;
        }
        .product-image img, .product-image {
            width: 40px !important;
            height: 40px !important;
        }
        .quantity-btn, .quantity-display {
            font-size: 12px;
            padding: 4px 8px;
            min-width: 24px;
            height: 24px;
        }
        .item-total {
            font-size: 12px;
        }
        .checkout-btn {
            font-size: 14px;
            padding: 10px;
        }
        .shipping-section, .shipping-address-content {
            padding: 8px 4px;
            font-size: 12px;
        }
        .dropdown-bar > div {
            flex-direction: column;
            gap: 8px;
            height: auto;
            padding: 4px;
        }
        .dropdown-pet, .dropdown-pet1 {
            width: 100%;
        }
    }
    @media (max-width: 480px) {
        .checkout-container {
            padding: 0 2px;
        }
        .product-section, .summary-section {
            padding: 4px;
        }
        .product-header, .product-item {
            font-size: 10px;
            gap: 2px;
            padding: 4px 0;
        }
        .product-image img, .product-image {
            width: 28px !important;
            height: 28px !important;
        }
        .quantity-btn, .quantity-display {
            font-size: 10px;
            padding: 2px 4px;
            min-width: 16px;
            height: 16px;
        }
        .item-total {
            font-size: 10px;
        }
        .checkout-btn {
            font-size: 12px;
            padding: 6px;
        }
        .shipping-section, .shipping-address-content {
            padding: 4px 2px;
            font-size: 10px;
        }
        .dropdown-bar > div {
            padding: 2px;
        }
    }
</style>
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
      <div class="checkout-container">
        <div class="product-section">
            <div class="product-header">
                <span>Product</span>
                <span>Quantity</span>
                <span>Total</span>
            </div>
            @if($items->count())
                @foreach($items as $item)
                    <div class="product-item" id="product-item-{{$item->id}}" data-price="{{ $item->product->price ?? 0 }}" data-quantity="{{ $item->quantity }}">
                        <div class="product-image">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->title }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                            @else
                                🐾
                            @endif
                        </div>
                        <div class="product-details">
                            <div class="product-name">{{ $item->product->title ?? 'Unknown Product' }}</div>
                            <div class="product-price">₱ {{ number_format($item->product->price ?? 0, 2) }}</div>
                        </div>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="changeQuantity('{{ $item->id }}', -1)">-</button>
                            <div class="quantity-display" id="quantity-display-{{ $item->id }}">{{ $item->quantity }}</div>
                            <button class="quantity-btn" onclick="changeQuantity('{{ $item->id }}', 1)">+</button>
                        </div>
                        <div class="item-total" id="item-total-{{ $item->id }}">₱ {{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}</div>
                        <form method="POST" action="{{ route('cart.item.remove', $item->id) }}" style="margin-left:10px;">
                            @csrf
                            <button type="submit" class="quantity-btn" title="Remove item" style="background:#e74c3c;">&times;</button>
                        </form>
                    </div>
                @endforeach
            @else
                <div style="padding: 20px; text-align: center; color: #8B4513;">Your cart is empty.</div>
            @endif
        </div>

        <div class="summary-section">
            <div class="total-amount">
                <div class="total-label">Total</div>
                <div class="total-price" id="totalPrice">
                    ₱ {{ number_format($items->sum(function($item) { return ($item->product->price ?? 0) * $item->quantity; }), 2) }}
                </div>
            </div>

            <div class="order-instruction">
                <select>
                    <option>Order Instruction</option>
                    <option>Leave at door</option>
                    <option>Ring doorbell</option>
                    <option>Call upon arrival</option>
                </select>
            </div>

            <div class="delivery-options">
                <button class="delivery-option active" onclick="selectDelivery('shipping')">
                    <div class="delivery-icon"><img src="{{ asset('assets/delivery-icon.png') }}" alt="Delivery Icon"></div>
                    <div>Shipping</div>
                </button>
                <button class="delivery-option" onclick="selectDelivery('pickup')">
                    <div class="delivery-icon"><img src="{{ asset('assets/pickup-icon.png') }}" alt="Pickup Icon"></div>
                    <div>Store Pick Up</div>
                </button>
            </div>

            <div class="checkout-note">
                Please click the checkout button to continue.
            </div>

            <form method="POST" action="{{ route('checkout') }}" style="margin:0;">
                @csrf
                <input type="hidden" name="delivery_option" id="delivery_option" value="shipping">
                <div style="margin-bottom: 15px;">
                    <label style="font-weight:bold;">Payment Method:</label><br>
                    <label><input type="radio" name="payment_method" value="Cash on Delivery" checked onchange="toggleGcashForm()"> Cash on Delivery</label><br>
                    <label><input type="radio" name="payment_method" value="GCash" onchange="toggleGcashForm()"> GCash</label><br>
                </div>
                <div id="gcash-form" style="display:none; margin-bottom: 15px;">
                    <label for="gcash_number" style="font-weight:bold;">GCash Number:</label>
                    <input type="text" id="gcash_number" name="gcash_number" class="form-control" placeholder="Enter your GCash number">
                </div>
                <button type="submit" class="checkout-btn">CHECKOUT</button>
            </form>
        </div>
    </div>

    <div class="shipping-section" onclick="toggleShipping()">
        <div class="shipping-icon" id="shippingIcon"><img src="{{ asset('assets/delivery-icon.png') }}" alt="Delivery Icon"></div>
        <div class="shipping-text" id="shippingText">Shipping Address</div>
        <div class="dropdown-arrow" id="dropdownArrow">▼</div>
    </div>
    
    <div class="shipping-address-content" id="shippingAddressContent">
        <div class="address-text" id="addressText">
            <strong>Default Shipping Address:</strong><br>
            @php
                $user = auth()->user();
            @endphp
            @if($user && ($user->shipping_name || $user->shipping_phone || $user->shipping_address))
                {{ $user->shipping_name ?? 'Name not set' }}<br>
                {{ $user->shipping_address ?? 'Address not set' }}<br>
                Phone: {{ $user->shipping_phone ?? 'Phone not set' }}
            @else
                John Doe<br>
                123 Main Street, Barangay San Juan<br>
                Lucena City, Calabarzon 4301<br>
                Philippines<br>
                Phone: +63 917 123 4567
            @endif
        </div>
        <button class="edit-address-btn" id="editAddressBtn" onclick="editAddress()">Edit Address</button>
    </div>

    <!-- Address Edit Modal -->
    <div class="modal-overlay" id="addressModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Address</h2>
                <button class="close-modal" onclick="closeAddressModal()">&times;</button>
            </div>
            <form method="POST" action="{{ route('cart.address.update') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="address_name">Name:</label>
                        <input type="text" id="address_name" name="name" value="{{ old('name', auth()->user()->shipping_name ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address_phone">Phone:</label>
                        <input type="tel" id="address_phone" name="phone" value="{{ old('phone', auth()->user()->shipping_phone ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address_address">Address:</label>
                        <textarea id="address_address" name="address" rows="3" required>{{ old('address', auth()->user()->shipping_address ?? '') }}</textarea>
                    </div>
                </div>
                <div class="modal-buttons">
                    <button type="submit" class="btn-save">Save</button>
                    <button type="button" class="btn-cancel" onclick="closeAddressModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let selectedDelivery = 'shipping';

        function toggleGcashForm() {
            var gcashForm = document.getElementById('gcash-form');
            var gcashRadio = document.querySelector('input[name="payment_method"][value="GCash"]');
            if (gcashRadio.checked) {
                gcashForm.style.display = 'block';
            } else {
                gcashForm.style.display = 'none';
            }
        }

        function changeQuantity(itemId, change) {
            const itemElement = document.getElementById(`product-item-${itemId}`);
            const quantityElement = document.getElementById(`quantity-display-${itemId}`);
            
            if (!itemElement || !quantityElement) return;

            const currentQuantity = parseInt(quantityElement.textContent);
            
            let newQuantity = currentQuantity + change;
            if (newQuantity < 1) {
                newQuantity = 1;
            }

            quantityElement.textContent = newQuantity;
            itemElement.dataset.quantity = newQuantity;

            updateItemTotal(itemId);
            updateCartTotal();
        }

        function updateItemTotal(itemId) {
            const itemElement = document.getElementById(`product-item-${itemId}`);
            if (!itemElement) return;

            const price = parseFloat(itemElement.dataset.price);
            const quantity = parseInt(itemElement.dataset.quantity);
            const total = price * quantity;
            
            const itemTotalElement = document.getElementById(`item-total-${itemId}`);
            if(itemTotalElement) {
                itemTotalElement.textContent = `₱ ${total.toFixed(2)}`;
            }
        }

        function updateCartTotal() {
            let cartTotal = 0;
            const items = document.querySelectorAll('.product-item');
            items.forEach(item => {
                const price = parseFloat(item.dataset.price);
                const quantity = parseInt(item.dataset.quantity);
                if (!isNaN(price) && !isNaN(quantity)) {
                    cartTotal += price * quantity;
                }
            });

            const totalPriceElement = document.getElementById('totalPrice');
            if (totalPriceElement) {
                totalPriceElement.textContent = `₱ ${cartTotal.toFixed(2)}`;
            }
        }

        function selectDelivery(option) {
            selectedDelivery = option;
            document.querySelectorAll('.delivery-option').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.closest('.delivery-option').classList.add('active');
            
            document.getElementById('delivery_option').value = option;

            // Update shipping section content based on delivery method
            updateShippingContent(option);
        }

          function updateShippingContent(deliveryMethod) {
            const shippingIcon = document.getElementById('shippingIcon');
            const shippingText = document.getElementById('shippingText');
            const addressText = document.getElementById('addressText');
            const editAddressBtn = document.getElementById('editAddressBtn');
            
            if (deliveryMethod === 'pickup') {
                shippingIcon.innerHTML = '<img src="{{ asset('assets/pickup-icon.png') }}" alt="Pickup Icon">';
                shippingText.textContent = 'Store Pick Up Instructions';
                addressText.innerHTML = `
                    <strong>STORE PICK UP INSTRUCTIONS</strong><br>
                    Your order should arrive at the preferred branch within the number of days below:<br><br>
                    <div style="text-align:center; font-weight:bold;">Silk Residences | Maui Oasis | PUP-Manila</div>
                    <table style="margin: 10px auto; border-collapse: collapse; min-width: 350px;">
                        <tr style="border:1px solid #333;"><th style="border:1px solid #333; padding:6px 16px;">ORDER PLACEMENT</th><th style="border:1px solid #333; padding:6px 16px;"></th></tr>
                        <tr><td style="border:1px solid #333; padding:6px 16px;">Monday to Thursday</td><td style="border:1px solid #333; padding:6px 16px;">2 days</td></tr>
                        <tr><td style="border:1px solid #333; padding:6px 16px;">Friday to Saturday</td><td style="border:1px solid #333; padding:6px 16px;">3 days</td></tr>
                        <tr><td style="border:1px solid #333; padding:6px 16px;">Sunday</td><td style="border:1px solid #333; padding:6px 16px;">2 days</td></tr>
                        <tr><td style="border:1px solid #333; padding:6px 16px;">Public Holidays</td><td style="border:1px solid #333; padding:6px 16px;">2 - 3 days (schedule may vary)</td></tr>
                    </table>
                `;
                editAddressBtn.style.display = 'none';
            } else {
                editAddressBtn.style.display = '';
               shippingIcon.innerHTML = '<img src="{{ asset('assets/delivery-icon.png') }}" alt="Delivery Icon">';
                shippingText.textContent = 'Shipping Address';
                addressText.innerHTML = `
                    <strong>Default Shipping Address:</strong><br>
                    @php
                        $user = auth()->user();
                    @endphp
                    @if($user && ($user->shipping_name || $user->shipping_phone || $user->shipping_address))
                        {{ $user->shipping_name ?? 'Name not set' }}<br>
                        {{ $user->shipping_address ?? 'Address not set' }}<br>
                        Phone: {{ $user->shipping_phone ?? 'Phone not set' }}
                    @else
                        Your Name<br>
                        Your address<br>
                        Your phone number
                    @endif
                `;
                editAddressBtn.textContent = 'Edit Address';
            }
        }

        function toggleShipping() {
            const content = document.getElementById('shippingAddressContent');
            const arrow = document.getElementById('dropdownArrow');
            
            if (content.classList.contains('show')) {
                content.classList.remove('show');
                arrow.classList.remove('open');
            } else {
                content.classList.add('show');
                arrow.classList.add('open');
            }
        }

        function removeCartItem(itemId) {
            const item = document.getElementById(itemId);
            if (item) {
                item.remove();
                updateTotalPrice();
            }
            // Optionally, show empty cart message
            const productSection = document.querySelector('.product-section');
            if (productSection.children.length <= 1) { // Only header left
                productSection.innerHTML += '<p>Your cart is empty.</p>';
            }
        }

        function editAddress() {
            document.getElementById('addressModal').style.display = 'flex';
        }

        function closeAddressModal() {
            document.getElementById('addressModal').style.display = 'none';
        }
    </script>

  
</div> <br> <br>
  @include('components.footer')
@endsection
