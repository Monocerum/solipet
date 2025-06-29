@extends('layouts.admin')

@section('title', 'Add Product')

@section('styles')
<style>
    .form-section {
        background-color: #f5f5f5;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .form-section h3 {
        color: #8B5A2B;
        font-weight: bold;
        margin-bottom: 1rem;
        border-bottom: 2px solid #E8C7AA;
        padding-bottom: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="table-container rounded-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Create New Product</h2>
        <a href="{{ route('admin.products') }}" class="text-gray-600 hover:text-gray-800 underline">
            ← Back to Products
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Information -->
        <div class="form-section">
            <h3>Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="Enter product name" required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Price *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-500">$</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" 
                               class="w-full border border-gray-300 rounded-lg p-3 pl-8 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                               placeholder="0.00" required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="Enter stock quantity" required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="Enter brand name">
                </div>
            </div>
        </div>

        <!-- Categorization -->
        <div class="form-section">
            <h3>Categorization</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                        <option value="">Select Category</option>
                        <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                        <option value="Toys" {{ old('category') == 'Toys' ? 'selected' : '' }}>Toys</option>
                        <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="Health & Care" {{ old('category') == 'Health & Care' ? 'selected' : '' }}>Health & Care</option>
                        <option value="Grooming" {{ old('category') == 'Grooming' ? 'selected' : '' }}>Grooming</option>
                        <option value="Beds & Furniture" {{ old('category') == 'Beds & Furniture' ? 'selected' : '' }}>Beds & Furniture</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Pet Type</label>
                    <select name="pet_type" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                        <option value="">Select Pet Type</option>
                        <option value="Dog" {{ old('pet_type') == 'Dog' ? 'selected' : '' }}>Dog</option>
                        <option value="Cat" {{ old('pet_type') == 'Cat' ? 'selected' : '' }}>Cat</option>
                        <option value="Bird" {{ old('pet_type') == 'Bird' ? 'selected' : '' }}>Bird</option>
                        <option value="Fish" {{ old('pet_type') == 'Fish' ? 'selected' : '' }}>Fish</option>
                        <option value="Small Animals" {{ old('pet_type') == 'Small Animals' ? 'selected' : '' }}>Small Animals</option>
                        <option value="Reptile" {{ old('pet_type') == 'Reptile' ? 'selected' : '' }}>Reptile</option>
                        <option value="All Pets" {{ old('pet_type') == 'All Pets' ? 'selected' : '' }}>All Pets</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="form-section">
            <h3>Product Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Material</label>
                    <input type="text" name="material" value="{{ old('material') }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="e.g., Cotton, Plastic, Metal">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Dimensions</label>
                    <input type="text" name="dimensions" value="{{ old('dimensions') }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="e.g., 12cm x 8cm x 5cm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Savings Text</label>
                <input type="text" name="savings" value="{{ old('savings') }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                       placeholder="e.g., Save 20%!, Special Offer!">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" 
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                          placeholder="Enter product description...">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Care Instructions</label>
                <textarea name="care_instructions" rows="3" 
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                          placeholder="How to care for this product...">{{ old('care_instructions') }}</textarea>
            </div>
        </div>

        <!-- Product Image -->
        <div class="form-section">
            <h3>Product Image</h3>
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Upload Image</label>
                <input type="file" name="image" accept="image/*" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
            </div>
        </div>

        <!-- Product Features -->
        <div class="form-section">
            <h3>Product Features</h3>
            <div id="features-container">
                <div class="flex gap-2 mb-2">
                    <input type="text" name="features[]" value="{{ old('features.0') }}" 
                           class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="Enter a product feature">
                    <button type="button" onclick="addFeature()" 
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        + Add
                    </button>
                </div>
            </div>
            <p class="text-sm text-gray-500">Add key features that make your product special</p>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('admin.products') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                Create Product
            </button>
        </div>
    </form>
</div>

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const newFeature = document.createElement('div');
    newFeature.className = 'flex gap-2 mb-2';
    newFeature.innerHTML = `
        <input type="text" name="features[]" 
               class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
               placeholder="Enter a product feature">
        <button type="button" onclick="removeFeature(this)" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Remove
        </button>
    `;
    container.appendChild(newFeature);
}

function removeFeature(button) {
    button.parentElement.remove();
}
</script>
@endsection