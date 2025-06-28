@extends('layouts.admin')

@section('content', 'Edit Product')
<div class="container mt-4">
    <h2>Edit Product</h2>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input name="stock" type="number" class="form-control" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
