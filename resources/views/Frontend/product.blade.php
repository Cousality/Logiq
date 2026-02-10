<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        /* PRODUCT HEADER */
        .product-header {
            padding: 3rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .breadcrumb {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.8;
            text-transform: uppercase;
        }

        .breadcrumb a {
            color: var(--text);
            text-decoration: none;
            font-weight: bold;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* PRODUCT CONTAINER */
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            padding: 3rem 5%;
            margin-bottom: 3rem;
        }

        /* IMAGE SECTION */
        .product-image-container {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .product-image {
            background: var(--white);
            border: 2px solid var(--text);
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* INFO SECTION */
        .product-info-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .product-details-section {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .product-price {
            font-size: 2rem;
            font-weight: bold;
            color: var(--red-pastel-1);
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--text);
        }

        .product-description {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* PRODUCT ACTIONS */
        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid var(--text);
        }

        .add-to-basket,
        .add-to-wishlist {
            width: 100%;
            padding: 1rem;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--text);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
        }

        .add-to-basket {
            background: var(--text);
            color: var(--bg-primary);
        }

        .add-to-basket:hover {
            background: var(--red-pastel-1);
            color: var(--white);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--text);
        }

        .add-to-wishlist {
            background: var(--bg-primary);
            color: var(--text);
        }

        .add-to-wishlist:hover {
            background: var(--bg-secondary);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--text);
        }

        /* INFO ROWS */
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .info-value {
            font-weight: 600;
        }

        /* BADGES */
        .badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid var(--text);
        }

        .badge-success {
            background: var(--bg-secondary);
            color: var(--text);
        }

        .badge-danger {
            background: var(--red-pastel-1);
            color: var(--white);
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 968px) {
            .product-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .product-header {
                background: var(--bg-primary);
            }

            .product-image-container {
                position: relative;
                top: 0;
            }

            .product-title {
                font-size: 2rem;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .product-image {
                box-shadow: 4px 4px 0px var(--text);
            }

            .product-image:hover {
                box-shadow: 6px 6px 0px var(--text);
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

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

    @include('Frontend.components.footer')
</body>

</html>
