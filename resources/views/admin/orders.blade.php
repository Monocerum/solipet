@extends('admin.layout')

@section('title', 'Order Management')



<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #DAB08A;
        color: black;
    }

    thead {
        background-color: #FEB87A;
    }

    th, td {
        padding: 1rem 1.25rem;
        word-wrap: break-word;
        max-width: 200px;
        color: #2B1500;
    }

    tbody td {
        background-color: #FAE3C2;
    }

    tbody tr:nth-child(even) td {
        background-color: #F7D7AE;
    }

    .btn-primary {
        background-color: #F59E0B;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #B45309;
        transform: translateY(-1px);
    }

    .btn-edit,
    .btn-delete {
        width: 100px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 12px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        border-radius: 6px;
        color: white;
        background-color: #F59E0B;
    }

    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #B45309;
    }

    .no-products {
        color: #4B5563;
    }

    .scrollable-table-wrapper {
        overflow-x: auto;
        overflow-y: auto;
        max-height: 80vh;
    }

    .scrollable-table-wrapper::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .scrollable-table-wrapper::-webkit-scrollbar-track {
        background: #FAE3C2;
        border-radius: 6px;
    }

    .scrollable-table-wrapper::-webkit-scrollbar-thumb {
        background-color: #F59E0B;
        border-radius: 6px;
        border: 2px solid #FAE3C2;
    }

    .scrollable-table-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: #B45309;
    }

    .order-actions-cell {
        position: relative;
        min-width: 300px;
    }

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
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
    }

    .update-btn:hover {
        background: linear-gradient(135deg, #B08968 0%,rgb(24, 19, 15) 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
    }

    .update-btn:active {
        transform: translateY(0);
    }

    .delete-container {
        position: relative;
    }

    .delete-btn {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }

    .delete-btn:active {
        transform: translateY(0);
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

    .status-badge.placed {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #60a5fa;
    }

    .status-badge.preparing {
        background: #fed7d7;
        color: #c53030;
        border: 1px solid #fc8181;
    }

    .status-badge.shipping {
        background: #e0e7ff;
        color: #5b21b6;
        border: 1px solid #a78bfa;
    }

    .status-badge.delivered {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #34d399;
    }

    .status-badge.cancelled {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #f87171;
    }

    .status-badge.returned {
        background: #f3e8ff;
        color: #6b21a8;
        border: 1px solid #c084fc;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-badge.pending .status-dot { background: #f59e0b; }
    .status-badge.placed .status-dot { background: #3b82f6; }
    .status-badge.preparing .status-dot { background: #ef4444; }
    .status-badge.shipping .status-dot { background: #8b5cf6; }
    .status-badge.delivered .status-dot { background: #10b981; }
    .status-badge.cancelled .status-dot { background: #ef4444; }
    .status-badge.returned .status-dot { background: #a855f7; }

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

    @media (max-width: 768px) {
        .order-actions-cell {
            min-width: 250px;
        }

        .actions-row {
            flex-direction: column;
            gap: 0.5rem;
        }

        .update-btn {
            width: 100%;
        }

        .delete-btn {
            width: 100%;
            min-width: auto;
        }
    }
</style>
@section('content')
<div class="table-container rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">ORDERS</h1>

    <div class="inner-container flex space-x-5 mb-6">
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'pending' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Pending
        </a>
        <a href="{{ route('admin.orders', ['status' => 'placed']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'placed' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Placed
        </a>
        <a href="{{ route('admin.orders', ['status' => 'preparing']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'preparing' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Preparing
        </a>
        <a href="{{ route('admin.orders', ['status' => 'shipping']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'shipping' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Shipping
        </a>
        <a href="{{ route('admin.orders', ['status' => 'delivered']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'delivered' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Delivered
        </a>
        <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'cancelled' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Cancelled
        </a>
        <a href="{{ route('admin.orders', ['status' => 'returned']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'returned' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Returned
        </a>
    </div>
    <div class="bg-orange-100 rounded-lg scrollable-table-wrapper ">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Order No.</th>
                    <th class="px-6 py-3 text-left font-semibold">User ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Products</th>
                    <th class="px-6 py-3 text-left font-semibold">Customer Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Date Ordered</th>
                    <th class="px-6 py-3 text-left font-semibold">Actions</th> <!-- NEW -->
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-50 even:bg-orange-100">
                    <td class="px-6 py-4">{{ $order->order_number }}</td>
                    <td class="px-6 py-4">{{ $order->user_id }}</td>
                    <td class="px-6 py-4">
                        @foreach($order->items as $item)
                            <div>{{ $item->product->name ?? 'N/A' }} x{{ $item->quantity }}</div>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">{{ $order->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $order->created_at->format('m-d-Y') }}</td>
                    <td class="px-6 py-4 order-actions-cell">
                        <!-- Current Status Badge -->
                        @php
                            $status = $order->status;
                        @endphp
                        <div class="status-badge {{ $status }}">
                            <span class="status-dot"></span>
                            {{ ucfirst($status) }}
                        </div>

                        <!-- Update Status Form -->
                        <div class="status-form-container">
                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="status-update-form">
                                @csrf
                                @method('PATCH')
                                
                                <label class="status-form-label">Update Order Status</label>
                                
                                <select name="order_status" class="status-select" required>
                                    <option value="" selected disabled>Select new status...</option>
                                    @foreach(['pending','placed','preparing','shipping','delivered','cancelled','returned'] as $statusOption)
                                        <option value="{{ $statusOption }}">
                                            {{ ucfirst($statusOption) }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <div class="actions-row">
                                    <button type="submit" class="update-btn tooltip" data-tooltip="Update order status">
                                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        <div class="loading-spinner"></div>
                                        <span class="btn-text">Update Status</span>
                                    </button>

                                    <!-- Delete Button -->
                                    <div class="delete-container">
                                        <button type="button" class="delete-btn tooltip" data-tooltip="Delete order" onclick="confirmDelete({{ $order->id }})">
                                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                        class="btn-edit btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </form>
                        </div>

                        <!-- Hidden Delete Form -->
                        <form id="delete-form-{{ $order->id }}" method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    <script>
                        // Enhanced form submission with loading state
                        document.addEventListener('DOMContentLoaded', function() {
                            const forms = document.querySelectorAll('.status-update-form');
                            
                            forms.forEach(form => {
                                form.addEventListener('submit', function(e) {
                                    const button = form.querySelector('.update-btn');
                                    button.classList.add('form-loading');
                                    button.disabled = true;
                                    
                                    // Re-enable button after 5 seconds as fallback
                                    setTimeout(() => {
                                        button.classList.remove('form-loading');
                                        button.disabled = false;
                                    }, 5000);
                                });
                            });
                        });

                        // Enhanced delete confirmation
                        function confirmDelete(orderId) {
                            // Remove any existing modals first
                            const existingModal = document.getElementById(`delete-modal-${orderId}`);
                            if (existingModal) {
                                existingModal.remove();
                            }

                            // Create custom modal instead of default confirm
                            const modal = document.createElement('div');
                            modal.id = `delete-modal-${orderId}`;
                            modal.className = 'delete-modal-overlay';
                            modal.innerHTML = `
                                <div class="delete-modal-backdrop" onclick="closeDeleteModal(${orderId})">
                                    <div class="delete-modal-content" onclick="event.stopPropagation()">
                                        <div class="delete-modal-header">
                                            <div class="delete-modal-icon">
                                                <svg style="width: 24px; height: 24px; color: #ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.99-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="delete-modal-title">Delete Order</h3>
                                            <p class="delete-modal-text">Are you sure you want to delete this order? This action cannot be undone.</p>
                                        </div>
                                        <div class="delete-modal-actions">
                                            <button type="button" class="delete-modal-cancel" onclick="closeDeleteModal(${orderId})">Cancel</button>
                                            <button type="button" class="delete-modal-confirm" onclick="confirmDeleteAction(${orderId})">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            `;

                            // Add modal styles
                            const style = document.createElement('style');
                            style.textContent = `
                                .delete-modal-overlay {
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    z-index: 1000;
                                    opacity: 0;
                                    visibility: hidden;
                                    transition: all 0.3s ease;
                                }
                                
                                .delete-modal-overlay.show {
                                    opacity: 1;
                                    visibility: visible;
                                }
                                
                                .delete-modal-backdrop {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: rgba(0, 0, 0, 0.5);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    padding: 1rem;
                                }
                                
                                .delete-modal-content {
                                    background: white;
                                    padding: 2rem;
                                    border-radius: 12px;
                                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                                    max-width: 400px;
                                    width: 100%;
                                    transform: scale(0.9) translateY(20px);
                                    transition: all 0.3s ease;
                                }
                                
                                .delete-modal-overlay.show .delete-modal-content {
                                    transform: scale(1) translateY(0);
                                }
                                
                                .delete-modal-header {
                                    text-align: center;
                                    margin-bottom: 1.5rem;
                                }
                                
                                .delete-modal-icon {
                                    width: 60px;
                                    height: 60px;
                                    background: #fee2e2;
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin: 0 auto 1rem;
                                }
                                
                                .delete-modal-title {
                                    font-size: 1.25rem;
                                    font-weight: 600;
                                    color: #374151;
                                    margin: 0 0 0.5rem;
                                    font-family: 'Inter', sans-serif;
                                }
                                
                                .delete-modal-text {
                                    color: #6b7280;
                                    margin: 0;
                                    font-family: 'Inter', sans-serif;
                                    line-height: 1.5;
                                }
                                
                                .delete-modal-actions {
                                    display: flex;
                                    gap: 0.75rem;
                                }
                                
                                .delete-modal-cancel,
                                .delete-modal-confirm {
                                    flex: 1;
                                    padding: 0.75rem 1rem;
                                    border: none;
                                    border-radius: 8px;
                                    font-weight: 500;
                                    cursor: pointer;
                                    font-family: 'Inter', sans-serif;
                                    transition: all 0.2s ease;
                                    font-size: 0.875rem;
                                }
                                
                                .delete-modal-cancel {
                                    background: #f3f4f6;
                                    color: #374151;
                                }
                                
                                .delete-modal-cancel:hover {
                                    background: #e5e7eb;
                                }
                                
                                .delete-modal-confirm {
                                    background: #ef4444;
                                    color: white;
                                }
                                
                                .delete-modal-confirm:hover {
                                    background: #dc2626;
                                }
                                
                                .delete-modal-confirm:active,
                                .delete-modal-cancel:active {
                                    transform: translateY(1px);
                                }
                            `;
                            
                            // Add styles to head if not already present
                            if (!document.getElementById('delete-modal-styles')) {
                                style.id = 'delete-modal-styles';
                                document.head.appendChild(style);
                            }

                            // Append modal to body
                            document.body.appendChild(modal);

                            // Show modal with animation
                            requestAnimationFrame(() => {
                                modal.classList.add('show');
                            });

                            // Add escape key listener
                            document.addEventListener('keydown', function escapeHandler(e) {
                                if (e.key === 'Escape') {
                                    closeDeleteModal(orderId);
                                    document.removeEventListener('keydown', escapeHandler);
                                }
                            });
                        }

                        // Close modal function
                        function closeDeleteModal(orderId) {
                            const modal = document.getElementById(`delete-modal-${orderId}`);
                            if (modal) {
                                modal.classList.remove('show');
                                setTimeout(() => {
                                    modal.remove();
                                }, 300); // Wait for animation to complete
                            }
                        }

                        // Confirm delete action
                        function confirmDeleteAction(orderId) {
                            const deleteForm = document.getElementById(`delete-form-${orderId}`);
                            if (deleteForm) {
                                deleteForm.submit();
                            }
                            closeDeleteModal(orderId);
                        }
                    </script>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2"></i>
                        <p>No orders found for this status.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection