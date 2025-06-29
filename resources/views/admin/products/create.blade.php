@extends('admin.layout')

@section('title', 'Add Product')

<style>
    body {
        background-color: #2B0B00;
    }

    .table-container {
        background-color: #E3B88A;
        color: #1f1f1f;
    }

    .form-header a,
    .form-section label {
        color: #3e2600;
    }

    .form-section {
        background-color: #FAE3C2;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid #FCD79A;
    }

    .form-section h3 {
        color: #5C2E00;
        font-weight: bold;
        margin-bottom: 1rem;
        border-bottom: 2px solid #E8C7AA;
        padding-bottom: 0.5rem;
    }

    input, select, textarea {
        background-color: #fff6ea;
        border-color: #d6a97d;
        color: #3e2600;
    }

    .btn-primary,
    .btn-save,
    .btn-edit,
    .btn-delete {
        background-color: #F59E0B;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover,
    .btn-save:hover,
    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #B45309;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background-color: #6b7280;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #4b5563;
    }

    .btn-danger {
        background-color: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    .feature-item input {
        flex: 1;
    }

    .alert-success {
        background-color: #4ade80;
        color: white;
        padding: 1rem;
        border-radius: 8px;
    }

    .alert-error {
        background-color: #f87171;
        color: white;
        padding: 1rem;
        border-radius: 8px;
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <div class="form-header flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create New Product</h1>
        <a href="{{ route('admin.products') }}">← Back to Products</a>
    </div>

    @if($errors->any())
    <div class="alert-error mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- BASIC INFO --}}
        <div class="form-section">
            <h3>Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-semibold mb-2 block">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg p-3" required>
                </div>
                <div>
                    <label class="font-semibold mb-2 block">Price *</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded-lg p-3" required>
                </div>
                <div>
                    <label class="font-semibold mb-2 block">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border rounded-lg p-3" required>
                </div>
                <div>
                    <label class="font-semibold mb-2 block">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" class="w-full border rounded-lg p-3">
                </div>
            </div>
        </div>

        {{-- CATEGORIZATION --}}
        <div class="form-section">
            <h3>Categorization</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-semibold mb-2 block">Category</label>
                    <select name="category" class="w-full border rounded-lg p-3">
                        <option value="">Select Category</option>
                        @foreach(['Food','Toys','Accessories','Health','Grooming','Bedding','Training','Travel'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="font-semibold mb-2 block">Pet Type</label>
                    <select name="pet_type" class="w-full border rounded-lg p-3">
                        <option value="">Select Pet Type</option>
                        @foreach(['Dog','Cat','Bird','Fish','Small Pet','Reptile','All Pets'] as $type)
                        <option value="{{ $type }}" {{ old('pet_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- DETAILS --}}
        <div class="form-section">
            <h3>Product Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-semibold mb-2 block">Material</label>
                    <input type="text" name="material" value="{{ old('material') }}" class="w-full border rounded-lg p-3">
                </div>
                <div>
                    <label class="font-semibold mb-2 block">Dimensions</label>
                    <input type="text" name="dimensions" value="{{ old('dimensions') }}" class="w-full border rounded-lg p-3">
                </div>
            </div>
            <div class="mt-4">
                <label class="font-semibold mb-2 block">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg p-3">{{ old('description') }}</textarea>
            </div>
            <div class="mt-4">
                <label class="font-semibold mb-2 block">Care Instructions</label>
                <textarea name="care_instructions" rows="3" class="w-full border rounded-lg p-3">{{ old('care_instructions') }}</textarea>
            </div>
        </div>

        {{-- IMAGE --}}
        <div class="form-section">
            <h3>Product Image</h3>
            <div>
                <label class="font-semibold mb-2 block">Upload Image</label>
                <input type="file" name="image" class="w-full border rounded-lg p-3" accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
            </div>
        </div>

        {{-- FEATURES --}}
        <div class="form-section">
            <h3>Product Features</h3>
            <div id="features-container">
                <div class="flex gap-2 mb-2 feature-item">
                    <input type="text" name="features[]" class="border rounded-lg p-3 w-full" placeholder="Feature description">
                    <button type="button" onclick="removeFeature(this)" class="btn-danger px-4 py-2 rounded-lg">Remove</button>
                </div>
            </div>
            <button type="button" onclick="addFeature()" class="btn-save mt-2 px-4 py-2 rounded-lg">+ Add Feature</button>
        </div>

        {{-- ACTIONS --}}
        <div class="flex justify-between border-t pt-6">
            <a href="{{ route('admin.products') }}" class="btn-cancel px-6 py-3 rounded-lg">Cancel</a>
            <button type="submit" class="btn-save px-6 py-3 rounded-lg font-semibold">Create Product</button>
        </div>
    </form>
</div>

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.classList.add('flex', 'gap-2', 'mb-2', 'feature-item');
    div.innerHTML = `
        <input type="text" name="features[]" class="border rounded-lg p-3 w-full" placeholder="Feature description">
        <button type="button" onclick="removeFeature(this)" class="btn-danger px-4 py-2 rounded-lg">Remove</button>
    `;
    container.appendChild(div);
}

function removeFeature(btn) {
    if (document.querySelectorAll('.feature-item').length > 1) {
        btn.parentElement.remove();
    }
}
</script>
@endsection
