<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Basket</title>
    <style>
      
        .content-wrapper {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        h1 {
            color: white;
            font-family: 'Inria Serif';
            text-align: center;
            margin-bottom: 2rem;
        }

        .basket-layout {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 2rem;
            align-items: flex-start;
        }

        .basket-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .basket-card {
            display: grid;
            grid-template-columns: 120px 1fr 140px;
            gap: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 1rem;
            transition: 0.2s;
        }

        .basket-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 100px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 0.9rem;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-name {
            font-size: 1rem;
            font-weight: bold;
            color: #310E0E;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .product-meta {
            font-size: 0.85rem;
            color: #777;
        }

        .basket-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .quantity-wrapper input[type="number"] {
            width: 70px;
            padding: 0.25rem 0.5rem;
        }

        .line-subtotal {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .remove-from-basket {
            padding: 0.4rem 0.75rem;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: bold;
            transition: 0.2s;
        }

        .remove-from-basket:hover {
            background: #c82333;
        }

        .update-basket {
            padding: 0.4rem 0.75rem;
            background: #310E0E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: bold;
            transition: 0.2s;
        }

        .update-basket:hover {
            background: #562323;
        }

        .basket-summary {
            background: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .basket-summary h2 {
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            color: #310E0E;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .summary-row.total {
            font-weight: bold;
            font-size: 1.1rem;
            margin-top: 0.75rem;
            border-top: 1px solid #ddd;
            padding-top: 0.75rem;
        }

        .checkout-button {
            margin-top: 1.5rem;
            width: 100%;
            padding: 0.75rem;
            background: #310E0E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: 0.2s;
        }

        .checkout-button:hover {
            background: #562323;
        }

        .empty-basket {
            text-align: center;
            padding: 3rem;
            color: white;
            font-size: 1.2rem;
        }

        .empty-basket a {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .basket-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .basket-card {
                grid-template-columns: 1fr;
            }

            .basket-actions {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <div class="content-wrapper">
        <h1>My Basket</h1>

        @if (!empty($basketItems) && count($basketItems) > 0)
            <div class="basket-layout">
                <div class="basket-grid">
                    @foreach ($basketItems as $item)
                        <div class="basket-card">
                            <div class="product-image">
                                @if (!empty($item->product->productImage))
                                    <img src="{{ $item->product->productImage }}"
                                         alt="{{ $item->product->productName }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <span>No image</span>
                                @endif
                            </div>

                            <div class="product-info">
                                <div>
                                    <div class="product-name">
                                        {{ $item->product->productName }}
                                    </div>
                                    <div class="product-price">
                                        £{{ number_format($item->product->productPrice, 2) }}
                                    </div>
                                    <div class="product-meta">
                                        Category: {{ $item->product->productCategory }}<br>
                                        Difficulty: {{ $item->product->productDifficulty }}
                                    </div>
                                </div>
                            </div>

                            <div class="basket-actions">
                                <div>
                                    <form action="{{ route('basket.update', $item->orderItemID) }}" method="POST" class="quantity-wrapper">
                                        @csrf
                                        @method('PUT')
                                        <label for="quantity-{{ $item->orderItemID }}">Qty:</label>
                                        <input
                                            id="quantity-{{ $item->orderItemID }}"
                                            type="number"
                                            name="quantity"
                                            min="1"
                                            value="{{ $item->quantity }}"
                                        >
                                        <button type="submit" class="update-basket">Update</button>
                                    </form>

                                    <div class="line-subtotal">
                                        Subtotal:
                                        £{{ number_format($item->product->productPrice * $item->quantity, 2) }}
                                    </div>
                                </div>

                                <form action="{{ route('basket.remove', $item->orderItemID) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-from-basket">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="basket-summary">
                    <h2>Order Summary</h2>

                    <div class="summary-row">
                        <span>Items ({{ $basketItems->sum('quantity') }})</span>
                        <span>
                            £{{ number_format($basketItems->sum(fn ($item) => $item->product->productPrice * $item->quantity), 2) }}
                        </span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span>
                            £{{ number_format($basketItems->sum(fn ($item) => $item->product->productPrice * $item->quantity), 2) }}
                        </span>
                    </div>

                    <form action="{{ route('checkout.index') }}" method="GET">
                        <button type="submit" class="checkout-button">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="empty-basket">
                <p>Your basket is empty :( </p>
                <p>Go add some products!</p>
                <p><a href="{{ route('store.index') }}">Continue Shopping</a></p>
            </div>
        @endif
    </div>

    {{-- basket.js is optional; you can remove this if you like --}}
    {{-- <script src="{{ asset('js/basket.js') }}"></script> --}}

</body>
@include('Frontend.components.footer')

</html>
