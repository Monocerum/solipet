@extends('admin.layout')

@section('title', 'All Payments')

<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #E8C7AA;
        color: black;
    }

    .table-container th, .table-container td {
        color: black;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
        font-family: 'Inter', sans-serif;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fcd34d;
    }

    .status-badge.paid {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #34d399;
    }

    .status-badge.failed {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #f87171;
    }

    .status-badge.refunded {
        background: #e0e7ff;
        color: #3730a3;
        border: 1px solid #a78bfa;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-badge.pending .status-dot { background: #f59e0b; }
    .status-badge.paid .status-dot { background: #10b981; }
    .status-badge.failed .status-dot { background: #ef4444; }
    .status-badge.refunded .status-dot { background: #8b5cf6; }

    .status-form-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .status-form-container:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .status-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-family: 'Inter', sans-serif;
    }

    .status-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        margin-bottom: 0.50rem;
        font-size: 0.875rem;
        color: #374151;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
        padding-right: 2.75rem;
    }

    .status-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .status-select option {
        padding: 0.5rem;
    }

    .actions-row {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .update-btn {
        flex: 1;
        background: linear-gradient(135deg, #B08968 0%, #E8C7AA 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 2px 4px rgba(176, 137, 104, 0.2);
    }

    .update-btn:hover {
        background: linear-gradient(135deg, #B08968 0%, #8B6F47 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(176, 137, 104, 0.3);
    }

    .update-btn:active {
        transform: translateY(0);
    }

    .update-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-icon {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .loading-spinner {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .form-loading .loading-spinner {
        display: inline-block;
    }

    .form-loading .btn-text {
        display: none;
    }

    .tooltip {
        position: relative;
    }

    .tooltip::before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #1f2937;
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
        z-index: 10;
    }

    .tooltip::after {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid transparent;
        border-top-color: #1f2937;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }

    .tooltip:hover::before,
    .tooltip:hover::after {
        opacity: 1;
        visibility: visible;
        bottom: calc(100% + 8px);
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .filter-tab.active {
        background-color: #FEB87A;
        color: #1f2937;
        font-weight: 600;
        border-color: #F59E0B;
    }

    .filter-tab:not(.active) {
        background-color: #FED7AA;
        color: #92400E;
    }

    .filter-tab:not(.active):hover {
        background-color: #FEB87A;
        color: #1f2937;
    }

    @media (max-width: 768px) {
        .payment-actions-cell {
            min-width: 250px;
        }

        .actions-row {
            flex-direction: column;
            gap: 0.5rem;
        }

        .update-btn {
            width: 100%;
        }

        .filter-tabs {
            flex-direction: column;
        }

        .filter-tab {
            text-align: center;
        }
    }
</style>

@section('content')
    <h1 class="text-2xl font-bold mb-6">ALL PAYMENTS</h1>

    <div class="bg-orange-100 rounded-lg overflow-x-auto">
        <div class="table-container rounded-lg p-6">
            <!-- Filter Tabs -->
            <div class="filter-tabs">
                @foreach(['all', 'pending', 'paid', 'failed', 'refunded'] as $filter)
                    <a href="{{ route('admin.payments', ['status' => $filter]) }}"
                       class="filter-tab {{ ($status ?? 'all') === $filter ? 'active' : '' }}">
                        {{ ucfirst($filter) }}
                    </a>
                @endforeach
            </div>

            <table class="w-full">
                <thead class="bg-[#FEB87A]">
                    <tr>
                        <th class="px-4 py-3">Payment ID</th>
                        <th class="px-4 py-3">Order Number</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Total Amount</th>
                        <th class="px-4 py-3">Discount</th>
                        <th class="px-4 py-3">Final Amount</th>
                        <th class="px-4 py-3">Payment Status</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Shipping Status</th>
                        <th class="px-4 py-3">Order Created</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-50 even:bg-orange-100">
                        <td class="px-4 py-3">{{ $payment->payment_number }}</td>
                        <td class="px-4 py-3">{{ $payment->order->order_number ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            {{ $payment->user->name ?? 'Unknown' }}<br>
                            <small>User ID: {{ $payment->user_id }}</small>
                        </td>
                        <td class="px-4 py-3">₱{{ number_format($payment->total_amount, 2) }}</td>
                        <td class="px-4 py-3">₱{{ number_format($payment->discount_amount, 2) }}</td>
                        <td class="px-4 py-3 font-semibold">₱{{ number_format($payment->final_amount, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="status-badge status-{{ $payment->payment_status }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($payment->payment_status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $payment->payment_method ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $payment->order->status ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-4 payment-actions-cell">
                            <!-- Update Payment Status Form -->
                            <div class="status-form-container">
                                <form method="POST" action="{{ route('admin.payments.update-status', $payment->id) }}" class="status-update-form" data-payment-id="{{ $payment->id }}">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <label class="status-form-label">Update Payment Status</label>
                                    
                                    <select name="payment_status" class="status-select" required>
                                        <option value="" disabled selected>Select new status...</option>
                                        @foreach(['pending', 'paid', 'failed', 'refunded'] as $statusOption)
                                            <option value="{{ $statusOption }}" {{ $payment->payment_status === $statusOption ? 'selected' : '' }}>
                                                {{ ucfirst($statusOption) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    <div class="actions-row">
                                        <button type="submit" class="update-btn tooltip" data-tooltip="Update payment status">
                                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            <div class="loading-spinner"></div>
                                            <span class="btn-text">Update Status</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <p>No orders found for this status.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($payments->hasPages())
            <div class="mt-6">
                {{ $payments->links() }}
            </div>
        @endif
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add CSRF token to head if not already present
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const csrfMeta = document.createElement('meta');
            csrfMeta.name = 'csrf-token';
            csrfMeta.content = '{{ csrf_token() }}';
            document.head.appendChild(csrfMeta);
        }

        // Attach submit event to all status update forms
        document.querySelectorAll('.status-update-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = form.querySelector('.update-btn');
                const spinner = form.querySelector('.loading-spinner');
                const btnText = form.querySelector('.btn-text');
                const select = form.querySelector('.status-select');
                const paymentId = form.dataset.paymentId;
                const newStatus = select.value;

                // Validation
                if (!newStatus) {
                    alert('Please select a status to update.');
                    return;
                }

                // Show loading state
                form.classList.add('form-loading');
                submitBtn.disabled = true;

                // Create FormData
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Update the status badge in the same row
                        const row = form.closest('tr');
                        const statusCell = row.querySelector('td:nth-child(7)'); // Payment Status column
                        const badge = statusCell.querySelector('.status-badge');
                        
                        if (badge) {
                            badge.className = `status-badge status-${newStatus}`;
                            badge.innerHTML = `<span class="status-dot"></span>${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}`;
                        }

                        // Reset form
                        select.selectedIndex = 0;
                        
                        // Refresh the page after successful update
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        // Refresh the page if there's an error too
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Refresh the page even on error
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                })
                .finally(() => {
                    // Hide loading state
                    form.classList.remove('form-loading');
                    submitBtn.disabled = false;
                });
            });
        });
    });
    </script>
@endsection