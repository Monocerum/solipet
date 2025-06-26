@extends('admin.layout')

@section('title', 'Inventory Management')
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
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">INVENTORY</h1>
    
    <div class="bg-orange-100 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Product ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Product Name</th>
                    <th class="px-6 py-3 text-left font-semibold">No. of Stocks</th>
                    <th class="px-6 py-3 text-left font-semibold">Reserved</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $product->id }}</td>
                    <td class="px-6 py-4">{{ $product->title }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded {{ $product->stock_quantity > 10 ? 'bg-green-200 text-green-800' : ($product->stock_quantity > 0 ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                            {{ $product->stock_quantity ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $product->reserved_quantity ?? 0 }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-warehouse text-4xl mb-2"></i>
                        <p>No inventory found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection