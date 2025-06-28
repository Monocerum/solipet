@extends('admin.layout')

@section('title', 'Edit Product')

<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #E8C7AA;
        color: black;
    }

    .table-container th,
    .table-container td {
        color: black;
    }

    thead {
        color: black;
    }

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

@section('content')
<div class="p-6 bg-orange-100 rounded-lg">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
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

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h3>Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Product Title *</label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                           required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Price *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-500">$</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                               class="w-full border border-gray-300 rounded-lg p-3 pl-8 focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent"
                           required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Categorization</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                        <option value="">Select Category</option>
                        @foreach(['Food', 'Toys', 'Accessories', 'Health & Care', 'Grooming', 'Beds & Furniture'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Pet Type</label>
                    <select name="pet_type" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                        <option value="">Select Pet Type</option>
                        @foreach(['Dog', 'Cat', 'Bird', 'Fish', 'Small Animals', 'Reptile', 'All Pets'] as $type)
                            <option value="{{ $type }}" {{ old('pet_type', $product->pet_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Product Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Material</label>
                    <input type="text" name="material" value="{{ old('material', $product->material) }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Dimensions</label>
                    <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Savings Text</label>
                <input type="text" name="savings" value="{{ old('savings', $product->savings) }}"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Care Instructions</label>
                <textarea name="care_instructions" rows="3"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">{{ old('care_instructions', $product->care_instructions) }}</textarea>
            </div>
        </div>

        <div class="form-section">
            <h3>Product Image</h3>
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Upload Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
            </div>
            @if($product->image)
                <div class="mt-3">
                    <label class="block font-semibold text-gray-700 mb-2">Current Image</label>
                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded w-full max-w-xs">
                </div>
            @endif
        </div>

        <div class="form-section">
            <h3>Product Features</h3>
            <div id="features-container">
                @foreach(old('features', $product->features ?? []) as $index => $feature)
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="features[]" value="{{ $feature }}"
                               class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                        <button type="button" onclick="removeFeature(this)"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            Remove
                        </button>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addFeature()"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                + Add
            </button>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('admin.products') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200">
                Cancel
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                Update Product
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
               class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
        <button type="button" onclick="removeFeature(this)"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Remove
        </button>`;
    container.appendChild(newFeature);
}

function removeFeature(button) {
    button.parentElement.remove();
}
</script>
@endsection
