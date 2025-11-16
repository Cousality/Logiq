@foreach ($wishlistItems as $item)
    <div class="wishlist-card">
        <div class="product-image">
            @if ($item->product->productImage)
                <img src="{{ asset('storage/' . $item->product->productImage) }}" alt="{{ $item->product->productName }}">
            @else
                Product Image
            @endif
        </div>
        <div class="product-info">
            <div class="product-name">{{ $item->product->productName }}</div>
            <div class="product-price">£{{ number_format($item->product->productPrice, 2) }}</div>
            <button class="add-to-basket" data-product-id="{{ $item->product->productID }}">Add to Basket</button>
            <button class="remove-from-wishlist" data-product-id="{{ $item->product->productID }}">Remove</button>
        </div>
    </div>
@endforeach
