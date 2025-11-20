@foreach ($products as $product)
    <a href="{{ route('product.index', $product->productSlug) }}" class="product-card-link">
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
             <form action="{{ route('basket.add') }}" method="POST" style="margin-bottom: 0.5rem;">
                @csrf
                <input type="hidden" name="productID" value="{{ $product->productID }}">
                <input type="hidden" name="quantity" value="1">

                <button type="submit" class="add-to-basket">
                    Add to Basket
                </button>
            </form>



                <button class="add-to-wishlist" data-product-id="{{ $product->productID }}">Add to Wishlist</button>
            </div>
        </div>
    </a>
@endforeach
