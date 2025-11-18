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
         
        <form action="{{ route('basket.add') }}" method="POST" style="margin-bottom: 0.5rem;">
    @csrf
    <input type="hidden" name="productID" value="{{ $item->product->productID }}">
    <input type="hidden" name="quantity" value="1">

    <button type="submit" class="add-to-basket">
        Add to Basket
    </button>
</form>


            <button class="remove-from-wishlist" data-product-id="{{ $item->product->productID }}">Remove</button>
        </div>
    </div>
@endforeach
