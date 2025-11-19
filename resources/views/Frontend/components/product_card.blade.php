@foreach ($products as $product)
    <a href="{{ route('product.show', $product->productID) }}" class="product-card-link">
        <div class="product-card" data-category="{{ $product->productCategory }}"
            data-difficulty="{{ $product->productDifficulty }}">
            <div class="product-image">
                @if ($product->productImage)
                    <img src="{{ asset('storage/' . $product->productImage) }}" alt="{{ $product->productName }}">
                @else
                    Product Image
                @endif
            </div>
            <div class="product-info">
                <div class="product-name">{{ $product->productName }}</div>
                <div class="product-price">£{{ number_format($product->productPrice, 2) }}</div>
                <button class="add-to-basket" data-product-id="{{ $product->productID }}">Add to Basket</button>
                <button class="add-to-wishlist" data-product-id="{{ $product->productID }}">Add to Wishlist</button>
            </div>
        </div>
    </a>
@endforeach
