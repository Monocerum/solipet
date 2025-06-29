@extends('admin.layout')

@section('name', 'Inventory Management')

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

    @media screen and (max-width: 500px) {
        .responsive {
            display: flex;
            flex-direction: column;
        }
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">

    <div class="flex justify-between items-center mb-6 responsive">
        <h1 class="text-2xl font-bold text-black">INVENTORY</h1>
        <a href="{{ route('admin.products.create') }}"
           class="btn-primary px-4 py-2 rounded-lg font-semibold inline-flex items-center gap-2 hover:shadow-lg">
            <i class="fas fa-plus"></i>
            Add Inventory
        </a>
    </div>

    <div class="bg-orange-100 rounded-lg  scrollable-table-wrapper">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Product ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Product Name</th>
                    <th class="px-6 py-3 text-left font-semibold">No. of Stocks</th>
                    <th class="px-6 py-3 text-left font-semibold">Reserved</th>
                    <th class="px-6 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $product->id }}</td>
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded {{ $product->stock > 10 ? 'bg-green-200 text-green-800' : ($product->stock > 0 ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                            {{ $product->stock ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $product->reserved_quantity ?? 0 }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <div class="flex justify-center gap-2">   
                            <a href="{{ route('admin.products.inventoryshow', $product->id) }}" 
                                    class="btn-edit btn-view">
                                        <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn-edit"
                                title="Edit Product">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button onclick="openDeleteConfirm({{ $product->id }}, '{{ $product->name }}')" class="btn-delete" title="Delete Product">
                                <i class="fas fa-trash-alt"></i> Delete
                                </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-warehouse text-4xl mb-2"></i>
                        <p>No inventory found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md">
        <div class="flex items-center gap-3 mb-4">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl"></i>
            <h2 class="text-xl font-bold text-gray-800">Confirm Deletion</h2>
        </div>
        <p class="text-gray-700 mb-6">Are you sure you want to permanently delete <span id="deleteProductName" class="font-semibold"></span>? This action cannot be undone.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeDeleteConfirm()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded-lg">Cancel</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteConfirm(id, name) {
    document.getElementById('deleteProductName').innerText = name;
    document.getElementById('deleteForm').action = `/admin/products/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteConfirm() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

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
