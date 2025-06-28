@extends('admin.layout')

@section('title', 'Products Management')

<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #E8C7AA;
        color: black;
    }

    th, td {
        color: black;
    }

    thead {
        color: black;
    }

    .btn-primary {
        background-color: #D97706;
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
        background-color: #F59E0B; /* Same amber as Edit */
    }

    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #B45309; /* Same hover effect */
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">PRODUCTS</h1>
        <a href="{{ route('admin.products.create') }}"
           class="btn-primary px-4 py-2 rounded-lg font-semibold inline-flex items-center gap-2 hover:shadow-lg">
            <i class="fas fa-plus"></i>
            Add Product
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
                    <th class="px-6 py-3 text-center font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $product->id }}</td>
                    <td class="px-6 py-4">{{ $product->title }}</td>
                    <td class="px-6 py-4">{{ $product->category ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $product->brand ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="btn-edit"
                               title="Edit Product">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this product?');"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Delete Product">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-box-open text-4xl mb-2"></i>
                        <p>No products found.</p>
                        <a href="{{ route('admin.products.create') }}"
                           class="btn-primary px-4 py-2 rounded-lg font-semibold inline-flex items-center gap-2 mt-4">
                            <i class="fas fa-plus"></i>
                            Add Your First Product
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(session('success'))
<div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="success-alert">
    <div class="flex items-center gap-2">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
</div>
<script>
    setTimeout(() => document.getElementById('success-alert').style.display = 'none', 3000);
</script>
@endif

@if(session('error'))
<div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="error-alert">
    <div class="flex items-center gap-2">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
</div>
<script>
    setTimeout(() => document.getElementById('error-alert').style.display = 'none', 3000);
</script>
@endif
@endsection
