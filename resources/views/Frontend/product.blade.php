<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #4A1F1F;
        }

        .product-name {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4em;
            min-height: 2.8em;
            margin-bottom: 0.5rem;
        }

        .product-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            flex-direction: row;
            align-items: flex-start;
        }

        .product-image-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
        }

        .product-image {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            aspect-ratio: 1;
            background-color: #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 18px;
        }

        .product-info-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            flex: 1;
        }

        .product-details-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-title {
            font-size: 32px;
            font-weight: bold;
            color: #310E0E;
            margin: 0;
        }

        .product-price {
            font-size: 28px;
            color: #4A1F1F;
            font-weight: 600;
            margin-top: auto;
        }

        .product-description {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .product-card-buttons {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .add-to-basket {
            flex: 1;
            padding: 15px 30px;
            background-color: #310E0E;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-basket:hover {
            background-color: #4A1F1F;
        }

        .add-to-wishlist {
            flex: 1;
            padding: 13px 30px;
            background-color: transparent;
            color: #310E0E;
            border: 2px solid #310E0E;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .add-to-wishlist:hover {
            background-color: #310E0E;
            color: white;
        }

        .product-info {
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            color: #333;
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <main>
    <div class="product-container">
        <div class="product-image-container">
            <div class="product-image">
                @if ($product->productImage)
                    <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}"
                        style="height: 100%; width: 100%;">
                @else
                    Product Image
                @endif
            </div>
        </div>

        <div class="product-info-container">
            <div class="product-details-section">
                <h1 class="product-title">{{ $product->productName }}</h1>

                <div class="product-price">£{{ number_format($product->productPrice, 2) }}</div>

                <div class="product-description">
                    <p>{{ $product->productDescription }}</p>
                </div>

                <div class="product-actions">
                    <form action="{{ route('basket.add') }}" method="POST" style="margin-bottom: 0.5rem;">
                        @csrf
                        <input type="hidden" name="productID" value="{{ $product->productID }}">

                        <button type="submit" class="add-to-basket">
                            Add to Basket
                        </button>
                    </form>
                    <form action="{{ route('wishlist.add') }}" method="POST" style="margin-bottom: 0.5rem;">
                        @csrf
                        <input type="hidden" name="productID" value="{{ $product->productID }}">

                        <button type="submit" class="add-to-wishlist">
                            Wishlist
                        </button>
                    </form>
                </div>

                <div class="info-row">
                    <span class="info-label">Availability:</span>
                    <span class="info-value">
                        @if ($product->productQuantity > 0)
                            <span class="badge badge-success">In Stock ({{ $product->productQuantity }})</span>
                        @else
                            <span class="badge badge-danger">Out of Stock</span>
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Category:</span>
                    <span class="info-value">{{ ucfirst($product->productCategory) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Difficulty:</span>
                    <span class="info-value">{{ ucfirst($product->productDifficulty) }}</span>
                </div>

            </div>
        </div>
    </div>
    </main>

    @include('Frontend.components.footer')
</body>

</html>
