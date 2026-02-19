<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Basket - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        /* BASKET HEADER */
        .basket-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .basket-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        .basket-subtitle {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        /* MAIN CONTAINER */
        .basket-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            padding: 3rem 5%;
            margin-bottom: 5rem;
        }

        /* BASKET ITEMS */
        .basket-items {
            background: var(--white);
            border: 2px solid var(--text);
        }

        .basket-item {
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 1.5rem;
            padding: 2rem;
            border-bottom: 1px solid var(--text);
            align-items: center;
            transition: opacity 0.3s;
        }

        .basket-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 120px;
            height: 120px;
            background: var(--red-pastel-1);
            border: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--text-light);
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .item-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .item-price {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            color: var(--text);
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
        }

        .qty-btn:hover:not(:disabled) {
            background: var(--text);
            color: var(--bg-primary);
        }

        .qty-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-display {
            min-width: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: flex-end;
        }

        .item-total {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .remove-btn {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--text);
            color: var(--text);
            cursor: pointer;
            font-family: inherit;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            background: var(--red-pastel-1);
            color: var(--text-light);
            border-color: var(--red-pastel-1);
        }

        /* ORDER SUMMARY */
        .order-summary {
            background: var(--bg-secondary);
            border: 2px solid var(--text);
            padding: 2rem;
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .summary-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid var(--text);
        }

        .summary-row:last-of-type {
            border-bottom: 2px solid var(--text);
            font-weight: bold;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }

        .checkout-btn {
            width: 100%;
            padding: 1.2rem;
            background: var(--text);
            color: var(--white);
            border: none;
            font-family: inherit;
            font-weight: bold;
            font-size: 1.1rem;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            background: var(--red-pastel-1);
        }

        .continue-shopping {
            display: block;
            text-align: center;
            margin-top: 1rem;
            padding: 1rem;
            background: transparent;
            border: 1px solid var(--text);
            color: var(--text);
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9rem;
            transition: all 0.2s;
            letter-spacing: 1px;
        }

        .continue-shopping:hover {
            background: var(--white);
        }

        /* PROMO CODE */
        .promo-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--text);
        }

        .promo-input {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .promo-input input {
            flex: 1;
            padding: 0.8rem;
            border: 1px solid var(--text);
            background: var(--white);
            color: var(--text);
            font-family: inherit;
            font-size: 0.9rem;
        }

        .promo-input button {
            padding: 0.8rem 1.5rem;
            background: var(--text);
            color: var(--white);
            border: none;
            font-family: inherit;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .promo-input button:hover {
            background: var(--red-pastel-1);
        }


        /* EMPTY BASKET */
        .empty-basket {
            text-align: center;
            padding: 5rem 2rem;
            background: var(--white);
            border: 2px solid var(--text);
            margin: 3rem 5%;
        }

        .empty-basket h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .empty-basket p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .empty-basket .cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--text);
            color: var(--white);
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s;
            text-transform: uppercase;
        }

        .empty-basket .cta-button:hover {
            transform: translateY(-3px);
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .basket-title {
                font-size: 2.5rem;
            }

            .basket-header {
                background: var(--bg-primary);
            }

            .basket-container {
                grid-template-columns: 1fr;
            }

            .basket-item {
                grid-template-columns: 80px 1fr;
                gap: 1rem;
            }

            .item-image {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
            }

            .item-actions {
                grid-column: 1 / -1;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                margin-top: 1rem;
            }

            .order-summary {
                position: static;
            }

            .quantity-controls {
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="basket-header">
        <h1 class="basket-title">YOUR BASKET.</h1>
        @if (!empty($basketItems) && count($basketItems) > 0)
            <p class="basket-subtitle">
                {{ $basketItems->sum('quantity') }} item{{ $basketItems->sum('quantity') !== 1 ? 's' : '' }} ready for
                checkout
            </p>
        @else
            <p class="basket-subtitle">Your basket is empty</p>
        @endif
    </header>

    @if (!empty($basketItems) && count($basketItems) > 0)
        <div class="basket-container">
            <!-- BASKET ITEMS -->
            <div class="basket-items">
                @foreach ($basketItems as $item)
                    @include('Frontend.components.basket_card', ['item' => $item])
                @endforeach
            </div>

            <!-- ORDER SUMMARY -->
            <div class="order-summary">
                <h2 class="summary-title">Order Summary</h2>

                <div class="summary-row">
                    <span>Items</span>
                    <span
                        id="subtotal">£{{ number_format($basketItems->sum(fn($item) => $item->product->productPrice * $item->quantity), 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Total</span>
                    <span
                        id="grand-total">£{{ number_format($basketItems->sum(fn($item) => $item->product->productPrice * $item->quantity), 2) }}</span>
                </div>

                <form action="{{ route('checkout.index') }}" method="GET">
                    <button type="submit" class="checkout-btn">
                        Proceed to Checkout
                    </button>
                </form>

                <a href="{{ route('store.index') }}" class="continue-shopping">
                    Continue Shopping
                </a>

                <div class="promo-section">
                    <strong>Have a promo code?</strong>
                    <div class="promo-input">
                        <input type="text" id="promo-code" placeholder="Enter code" />
                        <button onclick="applyPromo()">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-basket">
            <h2>Your Basket is Empty.</h2>
            <p>Time to add some brain-bending puzzles!</p>
            <a href="{{ route('store.index') }}" class="cta-button">Browse Store</a>
        </div>
    @endif

    @include('Frontend.components.footer')

    <script>
        function changeQuantity(itemId, change) {

            const qtyDisplay = document.getElementById(`qty-${itemId}`);
            let currentQty = parseInt(qtyDisplay.textContent);
            let newQty = currentQty + change;

            if (newQty < 1) newQty = 1;
            if (newQty > 99) newQty = 99;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/basket/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        quantity: newQty
                    })
                })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {

                        // Update quantity on screen
                        qtyDisplay.textContent = newQty;

                        // Update item total
                        const item = document.querySelector(`.basket-item[data-id="${itemId}"]`);
                        const price = parseFloat(item.dataset.price);
                        const itemTotal = (price * newQty).toFixed(2);
                        document.getElementById(`total-${itemId}`).textContent = `£${itemTotal}`;

                        // Update badge
                        const badge = document.getElementById('basket-count');
                        if (badge && data.basketCount > 0) {
                            badge.textContent = data.basketCount;
                        }

                        updateSummaryDisplay();
                    }
                })
                .catch(error => console.error(error));
        }

        // Update order summary display (client-side calculation)
        function updateSummaryDisplay() {
            const items = document.querySelectorAll('.basket-item');
            let subtotal = 0;
            let itemCount = 0;

            items.forEach(item => {
                const itemId = item.dataset.id;
                const price = parseFloat(item.dataset.price);
                const qty = parseInt(document.getElementById(`qty-${itemId}`).textContent);
                subtotal += price * qty;
                itemCount += qty;
            });

            const total = subtotal;

            document.getElementById('subtotal').textContent = `£${subtotal.toFixed(2)}`;
            document.getElementById('grand-total').textContent = `£${total.toFixed(2)}`;

            // Update header count
            const subtitle = document.querySelector('.basket-subtitle');
            if (subtitle) {
                subtitle.textContent = `${itemCount} item${itemCount !== 1 ? 's' : ''} ready for checkout`;
            }
        }

        function applyPromo() {
            const promoCode = document.getElementById('promo-code').value.trim();
            alert(`Promo code "${promoCode}" applied! (This is a demo, no actual discount will be applied)`);
        }
    </script>
</body>

</html>
