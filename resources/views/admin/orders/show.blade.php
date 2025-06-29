@extends('admin.layout')

@section('title', 'Order Details - #' . $order->id)

<style>
    .order-details-container {g
        background-color: #DAB08A;
        color: #2B1500;
        min-height: 90vh;
    }

    .detail-card {
        background-color: #FAE3C2;
        border: 1px solid #F7D7AE;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .status-timeline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 2rem 0;
        position: relative;
    }

    .timeline-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
        z-index: 2;
    }

    .timeline-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .timeline-icon.completed {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .timeline-icon.pending {
        background: #f3f4f6;
        color: #6b7280;
        border: 2px solid #d1d5db;
    }

    .timeline-line {
        position: absolute;
        top: 24px;
        left: 0;
        right: 0;
        height: 2px;
        background: #d1d5db;
        z-index: 1;
    }

    .timeline-progress {
        height: 100%;
        background: linear-gradient(135deg, #10b981, #059669);
        transition: width 0.5s ease;
    }

    .timeline-label {
        font-size: 0.875rem;
        font-weight: 600;
        text-align: center;
        color: #374151;
    }

    .btn-back {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #D97706, #B45309);
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-badge.pending { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
    .status-badge.placed { background: #dbeafe; color: #1e40af; border: 1px solid #60a5fa; }
    .status-badge.preparing { background: #fed7d7; color: #c53030; border: 1px solid #fc8181; }
    .status-badge.shipping { background: #e0e7ff; color: #5b21b6; border: 1px solid #a78bfa; }
    .status-badge.delivered { background: #d1fae5; color: #065f46; border: 1px solid #34d399; }
    .status-badge.cancelled { background: #fee2e2; color: #991b1b; border: 1px solid #f87171; }
    .status-badge.returned { background: #f3e8ff; color: #6b21a8; border: 1px solid #c084fc; }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #F7D7AE;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #374151;
    }

    .info-value {
        color: #2B1500;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        border: 1px solid #F7D7AE;
    }

    .product-image {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 8px;
        background: #f3f4f6;
    }

    .product-details {
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        color: #2B1500;
        margin-bottom: 0.25rem;
    }

    .product-meta {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .product-total {
        font-weight: 600;
        color: #F59E0B;
        font-size: 1.125rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
    }

    .summary-row.total {
        border-top: 2px solid #F59E0B;
        margin-top: 1rem;
        padding-top: 1rem;
        font-weight: 700;
        font-size: 1.25rem;
        color: #F59E0B;
    }

    @media (max-width: 768px) {
        .status-timeline {
            flex-direction: column;
            gap: 1rem;
        }

        .timeline-line {
            display: none;
        }

        .product-item {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

@section('content')
<div class="order-details-container p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold mb-2">Order #{{ $order->order_number }}</h1>
            <div class="status-badge {{ $order->status }}">
                <span class="w-2 h-2 bg-current rounded-full"></span>
                {{ ucfirst($order->status) }}
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.orders') }}" class="btn-back">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Orders
            </a>
        </div>
    </div>

    <!-- Status Timeline -->
    @if(!in_array($order->status, ['cancelled', 'returned']))
    <div class="detail-card p-6 mb-6">
        <h3 class="text-xl font-semibold mb-4">Order Progress</h3>
        <div class="status-timeline">
            <div class="timeline-line">
                <div class="timeline-progress" style="width: {{ (array_search($order->status, ['pending', 'placed', 'preparing', 'shipping', 'delivered']) + 1) * 20 }}%;"></div>
            </div>
            @foreach($statusProgression as $status => $details)
            <div class="timeline-step">
                <div class="timeline-icon {{ $details['completed'] ? 'completed' : 'pending' }}">
                    @if($details['icon'] === 'clock')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($details['icon'] === 'check-circle')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($details['icon'] === 'package')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    @elseif($details['icon'] === 'truck')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    @elseif($details['icon'] === 'home')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    @endif
                </div>
                <span class="timeline-label">{{ $details['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Information -->
        <div class="lg:col-span-2">
            <!-- Customer Information -->
            <div class="detail-card p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4">Customer Information</h3>
                <div class="info-row">
                    <span class="info-label">Customer Name:</span>
                    <span class="info-value">{{ $order->user->name ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $order->user->email ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone:</span>
                    <span class="info-value">{{ $order->user->phone ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Shipping Address:</span>
                    <span class="info-value">{{ $order->shipping_address ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- Order Items -->
            <div class="detail-card p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4">Order Items</h3>
                @forelse($order->items as $item)
                <div class="product-item">
                    <img src="{{ $item->product->image_url ?? '/images/placeholder.jpg' }}" 
                         alt="{{ $item->product->name ?? 'Product' }}" 
                         class="product-image">
                    <div class="product-details">
                        <div class="product-name">{{ $item->product->name ?? 'Deleted Product' }}</div>
                        <div class="product-meta">
                            Quantity: {{ $item->quantity }} × ₱{{ number_format($item->price, 2) }}
                        </div>
                    </div>
                    <div class="product-total">
                        ₱{{ number_format($item->quantity * $item->price, 2) }}
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No items found for this order.</p>
                @endforelse
            </div>
        </div>

        <!-- Order Summary & Details -->
        <div class="lg:col-span-1">
            <!-- Order Summary -->
            <div class="detail-card p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal ({{ $orderStats['total_items'] }} items):</span>
                    <span>₱{{ number_format($orderStats['total_amount'], 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping:</span>
                    <span>₱{{ number_format($orderStats['shipping_cost'], 2) }}</span>
                </div>
                @if($orderStats['tax_amount'] > 0)
                <div class="summary-row">
                    <span>Tax:</span>
                    <span>₱{{ number_format($orderStats['tax_amount'], 2) }}</span>
                </div>
                @endif
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>₱{{ number_format($orderStats['grand_total'], 2) }}</span>
                </div>
            </div>

            <!-- Order Details -->
            <div class="detail-card p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4">Order Details</h3>
                <div class="info-row">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value">{{ ucfirst($order->payment_method ?? 'N/A') }}</span>
                </div>
                @if($order->gcash_number)
                <div class="info-row">
                    <span class="info-label">GCash Number:</span>
                    <span class="info-value">{{ $order->gcash_number }}</span>
                </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Delivery Option:</span>
                    <span class="info-value">{{ ucfirst($order->delivery_option ?? 'N/A') }}</span>
                </div>
            </div>

            <!-- Payment Information -->
            @if($order->payment)
            <div class="detail-card p-6">
                <h3 class="text-xl font-semibold mb-4">Payment Information</h3>
                <div class="info-row">
                    <span class="info-label">Payment Status:</span>
                    <span class="info-value">
                        <span class="status-badge {{ $order->payment->status }}">
                            {{ ucfirst($order->payment->status) }}
                        </span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Amount Paid:</span>
                    <span class="info-value">₱{{ number_format($order->payment->amount, 2) }}</span>
                </div>
                @if($order->payment->paid_at)
                <div class="info-row">
                    <span class="info-label">Paid At:</span>
                    <span class="info-value">{{ $order->payment->paid_at->format('M d, Y H:i') }}</span>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection