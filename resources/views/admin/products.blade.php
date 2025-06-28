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

    .btn-edit {
        background-color: #059669;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background-color: #047857;
    }

    .btn-delete {
        background-color: #DC2626;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #B91C1C;
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">PRODUCTS</h1>
        <a href="#" onclick="alert('Please create the admin.products.create route first!')" class="btn-primary px-4 py-2 rounded-lg font-semibold inline-flex items-center gap-2 hover:shadow-lg">
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
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $product->id }}</td>
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $product->brand ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="#" onclick="alert('Please create the admin.products.edit route first!')" 
                               class="btn-edit px-3 py-1 rounded text-sm font-medium inline-flex items-center gap-1"
                               title="Edit Product">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <button onclick="if(confirm('Are you sure you want to delete this product?')) alert('Please create the admin.products.destroy route first!')" 
                                    class="btn-delete px-3 py-1 rounded text-sm font-medium inline-flex items-center gap-1"
                                    title="Delete Product">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-box-open text-4xl mb-2"></i>
                        <p>No products found.</p>
                        <a href="#" onclick="alert('Please create the admin.products.create route first!')" class="btn-primary px-4 py-2 rounded-lg font-semibold inline-flex items-center gap-2 mt-4">
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
    setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
    }, 3000);
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
    setTimeout(function() {
        document.getElementById('error-alert').style.display = 'none';
    }, 3000);
</script>
@endif
@endsection
