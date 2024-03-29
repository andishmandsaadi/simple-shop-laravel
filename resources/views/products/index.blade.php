@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="display-4">Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Likes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>
                    @if($product->image_path)
                        <img src="{{ Storage::url('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->likes_count }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection