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
            <button id="like-btn" data-liked="{{ $isLiked ? 'true' : 'false' }}" data-product-id="{{ $product->id }}">
                {{ $isLiked ? 'Unlike' : 'Like' }}
            </button>

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" style="width: auto;">
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>

            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">Back to list</a>
        </div>
    </div>
</div>
<script>
document.getElementById('like-btn').addEventListener('click', function() {
    const productId = this.dataset.productId;
    const liked = this.dataset.liked === 'true';
    const url = `/products/${productId}/like`;
    const method = liked ? 'DELETE' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ _token: "{{ csrf_token() }}" })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Toggle the liked state
            this.dataset.liked = !liked;
            this.innerText = !liked ? 'Unlike' : 'Like';
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

</script>

@endsection
