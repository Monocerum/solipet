@extends('admin.layout')

@section('title', 'Add Product')

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
<div class="p-6 bg-orange-100 rounded-lg">
    <h2 class="text-xl font-bold mb-4">Create New Product</h2>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Price</label>
            <input type="number" step="0.01" name="price" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Stock</label>
            <input type="number" name="stock" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border border-gray-300 rounded p-2"></textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Save
            </button>
            <a href="{{ route('admin.products') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
