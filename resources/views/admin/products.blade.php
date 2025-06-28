@extends('admin.layout')

@section('name', 'Products Management')

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
    <h1 class="text-2xl font-bold mb-6">PRODUCTS</h1>

    <div class="mb-4">
        <a href="{{ route('admin.products.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
            + Add Product
        </a>
    </div>

    <div class="bg-orange-100 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Product ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Product Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Category</th>
                    <th class="px-6 py-3 text-left font-semibold">Brand</th>
                    <th class="px-6 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $product->id }}</td>
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $product->brand ?? 'N/A' }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                            Edit
                        </a>
                        <form action="{{ route('admin.products.delete', $product->id) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-box-open text-4xl mb-2"></i>
                        <p>No products found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
