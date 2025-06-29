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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
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