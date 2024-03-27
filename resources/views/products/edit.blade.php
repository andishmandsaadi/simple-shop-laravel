@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <div>
                <img src="{{ Storage::url('images/' . $product->image) }}" alt="Current Image" style="width:100%;max-width:200px;margin-bottom:15px;">
            </div>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection