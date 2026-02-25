<div class="basket-item" data-id="{{ $item->orderItemID }}" data-price="{{ $item->product->productPrice }}">
    <div class="item-image">
        @if (!empty($item->product->productImage))
            <img src="{{ $item->product->productImage }}" alt="{{ $item->product->productName }}">
        @else
            <span>empty</span>
        @endif
    </div>
    <div class="item-details">
        <h3>{{ $item->product->productName }}</h3>
        <div class="item-meta">
            <span>Category: {{ $item->product->productCategory }}</span>
            <span>Difficulty: {{ $item->product->productDifficulty }}</span>
        </div>
        <div class="item-price">£{{ number_format($item->product->productPrice, 2) }}</div>
        <div class="quantity-controls">
            <button class="qty-btn" data-id="{{ $item->orderItemID }}" data-delta="-1" onclick="changeQuantity(+this.dataset.id, +this.dataset.delta)">-</button>
            <span class="qty-display" id="qty-{{ $item->orderItemID }}">{{ $item->quantity }}</span>
            <button class="qty-btn" data-id="{{ $item->orderItemID }}" data-delta="1" onclick="changeQuantity(+this.dataset.id, +this.dataset.delta)">+</button>
        </div>
    </div>
    <div class="item-actions">
        <div class="item-total" id="total-{{ $item->orderItemID }}">
            £{{ number_format($item->product->productPrice * $item->quantity, 2) }}
        </div>
        <form action="{{ route('basket.remove', $item->orderItemID) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="remove-btn">Remove</button>
        </form>

    </div>
</div>
