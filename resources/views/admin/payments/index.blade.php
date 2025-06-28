@extends('admin.layout')

@section('title', 'Payment Management')

<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #E8C7AA;
        color: black;

        th, td {
            color: black;
        }
    }

    .inner-container {
        a {
            color: black;
        }
    }

    thead {
        color: black;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending { background-color: #FEF3C7; color: #92400E; }
    .status-paid { background-color: #D1FAE5; color: #065F46; }
    .status-failed { background-color: #FEE2E2; color: #991B1B; }
    .status-refunded { background-color: #E0E7FF; color: #3730A3; }

    .info-card {
        background-color: #FEB87A;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 8px;
    }

    .shipping-info {
        font-size: 14px;
        line-height: 1.4;
    }

    .promotion-tag {
        background-color: #10B981;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">PAYMENT MANAGEMENT</h1>
        <a href="{{ route('admin.payments.promotions') }}" 
           class="px-4 py-2 bg-[#FEB87A] rounded-lg font-semibold hover:bg-orange-300 transition-colors">
            Manage Promotions
        </a>
    </div>

    <div class="inner-container flex space-x-5 mb-6">
        <a href="{{ route('admin.payments', ['status' => 'all']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'all' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            All Payments
        </a>
        <a href="{{ route('admin.payments', ['status' => 'pending']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'pending' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Pending
        </a>
        <a href="{{ route('admin.payments', ['status' => 'paid']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'paid' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Paid
        </a>
        <a href="{{ route('admin.payments', ['status' => 'failed']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'failed' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Failed
        </a>
        <a href="{{ route('admin.payments', ['status' => 'refunded']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'refunded' ? 'bg-[#FEB87A] font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Refunded
        </a>
    </div>

    <div class="bg-orange-100 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Payment No.</th>
                    <th class="px-6 py-3 text-left font-semibold">Order No.</th>
                    <th class="px-6 py-3 text-left font-semibold">Customer</th>
                    <th class="px-6 py-3 text-left font-semibold">Total Cost</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                    <th class="px-6 py-3 text-left font-semibold">Shipping Info</th>
                    <th class="px-6 py-3 text-left font-semibold">Promotion</th>
                    <th class="px-6 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-50 even:bg-orange-100">
                    <td class="px-6 py-4">
                        <div class="font-semibold">{{ $payment->payment_number }}</div>
                        <div class="text-sm text-gray-600">{{ $payment->created_at->format('M d, Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold">{{ $payment->order->order_number ?? 'N/A' }}</div>
                        @if($payment->order->product)
                            <div class="text-sm text-gray-600">{{ Str::limit($payment->order->product->name, 30) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold">{{ $payment->user->name ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">ID: {{ $payment->user_id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold">₱{{ number_format($payment->final_amount, 2) }}</div>
                        @if($payment->discount_amount > 0)
                            <div class="text-sm text-gray-600">
                                Original: ₱{{ number_format($payment->total_amount, 2) }}
                            </div>
                            <div class="text-sm text-green-600">
                                Discount: -₱{{ number_format($payment->discount_amount, 2) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge status-{{ $payment->payment_status }}">
                            {{ ucfirst($payment->payment_status) }}
                        </span>
                        @if($payment->payment_method)
                            <div class="text-sm text-gray-600 mt-1">{{ $payment->payment_method }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($payment->order->shippingInfo)
                            <div class="info-card">
                                <div class="shipping-info">
                                    <strong>{{ $payment->order->shippingInfo->recipient_name }}</strong><br>
                                    {{ $payment->order->shippingInfo->address }}<br>
                                    {{ $payment->order->shippingInfo->city }}, {{ $payment->order->shippingInfo->state }}
                                    @if($payment->order->shippingInfo->tracking_number)
                                        <br><strong>Tracking:</strong> {{ $payment->order->shippingInfo->tracking_number }}
                                    @endif
                                </div>
                            </div>
                        @else
                            <span class="text-gray-500">No shipping info</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($payment->promotion)
                            <div class="promotion-tag">{{ $payment->promotion->voucher_code }}</div>
                            <div class="text-sm text-gray-600 mt-1">{{ $payment->promotion->name }}</div>
                        @else
                            <span class="text-gray-500">None</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.payments.show', $payment) }}" 
                               class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                                View
                            </a>
                            @if($payment->payment_status === 'pending')
                                <form method="POST" action="{{ route('admin.payments.update-status', $payment) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="payment_status" value="paid">
                                    <button type="submit" 
                                            class="px-3 py-1 bg-green-500 text-white rounded text-sm hover:bg-green-600">
                                        Mark Paid
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-credit-card text-4xl mb-2"></i>
                        <p>No payments found for this status.</p>
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
@endsection