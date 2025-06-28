@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Product</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $product->name ?? $product->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                                       id="price" name="price" value="{{ old('price', $product->price) }}" 
                                                       step="0.01" min="0" required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                                   id="stock" name="stock" value="{{ old('stock', $product->stock) }}" 
                                                   min="0" required>
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="brand" class="form-label">Brand</label>
                                            <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                                                   id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
                                            @error('brand')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                                                <option value="">Select Category</option>
                                                @foreach(['Food', 'Toys', 'Accessories', 'Health', 'Grooming', 'Bedding', 'Training', 'Travel'] as $cat)
                                                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                                        {{ $cat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="pet_type" class="form-label">Pet Type</label>
                                            <select class="form-control @error('pet_type') is-invalid @enderror" id="pet_type" name="pet_type">
                                                <option value="">Select Pet Type</option>
                                                @foreach(['Dog', 'Cat', 'Bird', 'Fish', 'Small Pet', 'Reptile', 'All Pets'] as $type)
                                                    <option value="{{ $type }}" {{ old('pet_type', $product->pet_type) == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pet_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="material" class="form-label">Material</label>
                                            <input type="text" class="form-control @error('material') is-invalid @enderror" 
                                                   id="material" name="material" value="{{ old('material', $product->material) }}">
                                            @error('material')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="dimensions" class="form-label">Dimensions</label>
                                            <input type="text" class="form-control @error('dimensions') is-invalid @enderror" 
                                                   id="dimensions" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}" 
                                                   placeholder="e.g., 10cm x 5cm x 3cm">
                                            @error('dimensions')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="care_instructions" class="form-label">Care Instructions</label>
                                    <textarea class="form-control @error('care_instructions') is-invalid @enderror" 
                                              id="care_instructions" name="care_instructions" rows="3">{{ old('care_instructions', $product->care_instructions) }}</textarea>
                                    @error('care_instructions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="savings" class="form-label">Savings/Discount Info</label>
                                    <input type="text" class="form-control @error('savings') is-invalid @enderror" 
                                           id="savings" name="savings" value="{{ old('savings', $product->savings) }}" 
                                           placeholder="e.g., Save 20%!">
                                    @error('savings')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Features Section -->
                                <div class="form-group mb-3">
                                    <label class="form-label">Product Features</label>
                                    <div id="features-container">
                                        @if(old('features', $product->features))
                                            @foreach(old('features', $product->features) as $index => $feature)
                                                <div class="input-group mb-2 feature-item">
                                                    <input type="text" class="form-control" name="features[]" 
                                                           value="{{ $feature }}" placeholder="Enter feature">
                                                    <button type="button" class="btn btn-outline-danger remove-feature">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2 feature-item">
                                                <input type="text" class="form-control" name="features[]" 
                                                       placeholder="Enter feature">
                                                <button type="button" class="btn btn-outline-danger remove-feature">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-feature">
                                        <i class="fas fa-plus"></i> Add Feature
                                    </button>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Max file size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                                </div>

                                <!-- Current Image Preview -->
                                @if($product->image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div class="border rounded p-2">
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 200px; width: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif

                                <!-- New Image Preview -->
                                <div id="image-preview" class="mb-3" style="display: none;">
                                    <label class="form-label">New Image Preview</label>
                                    <div class="border rounded p-2">
                                        <img id="preview-img" src="" alt="Preview" 
                                             class="img-fluid rounded" 
                                             style="max-height: 200px; width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Add new feature
    $('#add-feature').click(function() {
        const newFeature = `
            <div class="input-group mb-2 feature-item">
                <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
                <button type="button" class="btn btn-outline-danger remove-feature">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        $('#features-container').append(newFeature);
    });

    // Remove feature
    $(document).on('click', '.remove-feature', function() {
        if ($('.feature-item').length > 1) {
            $(this).closest('.feature-item').remove();
        }
    });

    // Image preview
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-img').attr('src', e.target.result);
                $('#image-preview').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#image-preview').hide();
        }
    });
});
</script>
@endsection