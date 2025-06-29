@extends('admin.layout')

@section('name', 'Edit Product')

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
<div class="p-6 bg-orange-100 rounded-lg">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
        <a href="{{ route('admin.products') }}" class="text-gray-600 hover:text-gray-800 underline">
            ← Back to Products
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="form-section">
            <h3>Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? $product->title) }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="Enter product name" required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Price *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-500">$</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" 
                               class="w-full border border-gray-300 rounded-lg p-3 pl-8 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                               placeholder="0.00" required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="Enter stock quantity" required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" 
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
                        @foreach(['Food', 'Toys', 'Accessories', 'Health', 'Grooming', 'Bedding', 'Training', 'Travel'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Pet Type</label>
                    <select name="pet_type" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent">
                        <option value="">Select Pet Type</option>
                        @foreach(['Dog', 'Cat', 'Bird', 'Fish', 'Small Pet', 'Reptile', 'All Pets'] as $type)
                            <option value="{{ $type }}" {{ old('pet_type', $product->pet_type) == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
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
                    <input type="text" name="material" value="{{ old('material', $product->material) }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="e.g., Cotton, Plastic, Metal">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Dimensions</label>
                    <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                           placeholder="e.g., 10cm x 5cm x 3cm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Savings/Discount Info</label>
                <input type="text" name="savings" value="{{ old('savings', $product->savings) }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                       placeholder="e.g., Save 20%!">
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" 
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                          placeholder="Enter product description...">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">Care Instructions</label>
                <textarea name="care_instructions" rows="3" 
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                          placeholder="How to care for this product...">{{ old('care_instructions', $product->care_instructions) }}</textarea>
            </div>
        </div>

        <!-- Product Image -->
        <div class="form-section">
            <h3>Product Image</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Upload New Image</label>
                    <input type="file" name="image" accept="image/*" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
                    
                    <!-- New Image Preview -->
                    <div id="image-preview" class="mt-4" style="display: none;">
                        <label class="block font-semibold text-gray-700 mb-2">New Image Preview</label>
                        <div class="border border-gray-300 rounded-lg p-2">
                            <img id="preview-img" src="" alt="Preview" 
                                 class="w-full h-48 object-cover rounded">
                        </div>
                    </div>
                </div>

                <!-- Current Image -->
                @if($product->image)
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Current Image</label>
                        <div class="border border-gray-300 rounded-lg p-2">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->title }}" 
                                 class="w-full h-48 object-cover rounded">
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Features -->
        <div class="form-section">
            <h3>Product Features</h3>
            <div id="features-container">
                @if(old('features', $product->features))
                    @foreach(old('features', $product->features) as $index => $feature)
                        <div class="flex gap-2 mb-2 feature-item">
                            <input type="text" name="features[]" value="{{ $feature }}" 
                                   class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                                   placeholder="Enter a product feature">
                            <button type="button" onclick="removeFeature(this)" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                                Remove
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="flex gap-2 mb-2 feature-item">
                        <input type="text" name="features[]" 
                               class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-300 focus:border-transparent" 
                               placeholder="Enter a product feature">
                        <button type="button" onclick="removeFeature(this)" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            Remove
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addFeature()" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200 mt-2">
                + Add Feature
            </button>
            <p class="text-sm text-gray-500 mt-2">Add key features that make your product special</p>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('admin.products') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                Update Product
            </button>
        </div>
    </form>
</div>

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const newFeature = document.createElement('div');
    newFeature.className = 'flex gap-2 mb-2 feature-item';
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
    if (document.querySelectorAll('.feature-item').length > 1) {
        button.parentElement.remove();
    }
}

// Image preview
document.getElementById('image').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('image-preview').style.display = 'none';
    }
});
</script>
@endsection
