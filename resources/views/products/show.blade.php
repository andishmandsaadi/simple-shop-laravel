@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $product->name }}</h1>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            @if($product->image_path)
                <img src="{{ Storage::url('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3" style="max-width:300px;">
            @else
                <p>No image available.</p>
            @endif
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>
</div>
@endsection
