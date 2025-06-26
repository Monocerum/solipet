@extends('admin.layout')

@section('title', 'Order Management')

<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #E8C7AA;
        color: black;
    }

    .inner-container {
        a {
            color: black;
        }
    }

    thead {
        color: black;
        border-bottom: 1px solid;
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <div class="inner-container flex space-x-5 mb-6">
        <a href="{{ route('admin.orders', ['status' => 'placed']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'placed' ? 'bg-orange-200 font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Placed
        </a>
        <a href="{{ route('admin.orders', ['status' => 'preparing']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'preparing' ? 'bg-orange-200 font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Preparing
        </a>
        <a href="{{ route('admin.orders', ['status' => 'shipping']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'shipping' ? 'bg-orange-200 font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Shipping
        </a>
        <a href="{{ route('admin.orders', ['status' => 'delivered']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'delivered' ? 'bg-orange-200 font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Delivered
        </a>
        <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'cancelled' ? 'bg-orange-200 font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Cancelled
        </a>
        <a href="{{ route('admin.orders', ['status' => 'returned']) }}" 
           class="px-4 py-2 rounded-lg {{ $status === 'returned' ? 'bg-orange-200 font-semibold' : 'bg-orange-100 hover:bg-orange-200' }}">
            Returned
        </a>
    </div>
    <div class="bg-orange-100 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Order No.</th>
                    <th class="px-6 py-3 text-left font-semibold">User ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Product</th>
                    <th class="px-6 py-3 text-left font-semibold">Customer Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Date Ordered</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-50 even:bg-orange-100">
                    <td class="px-6 py-4">{{ $order->order_number }}</td>
                    <td class="px-6 py-4">{{ $order->user_id }}</td>
                    <td class="px-6 py-4">{{ $order->product->title ?? 'N/A' }}</td>
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