@extends('Admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
            <h3>Edit Product</h3>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Seller</label>
                        <select name="seller_id" class="form-control" required>
                            <option value="">Select Seller</option>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}" {{ $product->seller_id == $seller->id ? 'selected' : '' }}>
                                    {{ $seller->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group"><label>Name</label><input type="text" name="name" value="{{ $product->name }}" class="form-control" required></div>
                    <div class="form-group"><label>SKU</label><input type="text" name="sku" value="{{ $product->sku }}" class="form-control"></div>
                    <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea></div>
                    <div class="form-group"><label>Price</label><input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control" required></div>
                    <div class="form-group"><label>Quantity</label><input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" required></div>
                    <div class="form-group"><label>Unit</label><input type="text" name="unit" value="{{ $product->unit }}" class="form-control"></div>
                    <div class="form-group"><label>Freshness</label><input type="text" name="freshness" value="{{ $product->freshness }}" class="form-control"></div>

                    <div class="form-group">
                        <label>Current Image</label>
                        <div class="mb-2">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" width="100" class="rounded border">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </div>
                        <label>Replace Image</label>
                        <input type="file" name="image" class="form-control-file">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>

                    <button type="submit" class="btn btn-success">Update Product</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);
</script>
@endsection
