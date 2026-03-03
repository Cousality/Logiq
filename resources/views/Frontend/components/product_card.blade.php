@foreach ($products as $product)
    <style>
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 3rem;
            align-items: stretch;
        }

        .product-card {
            background: var(--white);
            border: 2px solid var(--text);
            box-shadow: 0px 0px 0px var(--text);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .card-link-wrapper {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-image-container {
            height: 220px;
            background: var(--bg-secondary);
            border-bottom: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .card-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder-icon {
            font-size: 4rem;
        }

        /* Content Layout */
        .card-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-header {
            margin-bottom: 0.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            line-height: 1.2;
            text-transform: uppercase;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--red-pastel-1);
            display: block;
            margin-top: 0.5rem;
        }

        .card-description {
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            opacity: 0.8;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-meta {
            margin-top: auto;
        }

        .meta-tag {
            background: var(--bg-secondary);
            border: 1px solid var(--text);
            padding: 0.25rem 0.5rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Action Area */
        .card-actions {
            padding: 1.5rem;
            padding-top: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .w-full {
            width: 100%;
        }

        .btn-style {
            width: 100%;
            padding: 0.8rem;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--text);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .btn-wishlist {
            background: var(--bg-primary);
        }

        .btn-primary {
            background: var(--text);
            color: var(--bg-primary);
        }

        .btn-primary:hover {
            background: var(--red-pastel-1);
            color: var(--white);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
        }

        .btn-secondary:hover {
            background: var(--bg-secondary);
        }

        .card-rating {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.35rem;
            margin-bottom: 0.1rem;
        }

        .card-stars-wrap {
            position: relative;
            display: inline-block;
            font-size: 1rem;
            line-height: 1;
            white-space: nowrap;
        }

        .card-stars-wrap .stars-bg {
            color: #ccc;
            letter-spacing: 1px;
        }

        .card-stars-wrap .stars-fg {
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            white-space: nowrap;
            color: #c8871a;
            letter-spacing: 1px;
        }

        .card-review-count {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text);
            opacity: 0.65;
        }

        .difficulty-badge {
            position: absolute;
            top: 0;
            right: 0;
            color: #ffffff;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            font-weight: bold;
            border-left: 2px solid var(--text);
            border-bottom: 2px solid var(--text);
            z-index: 10;
        }

        .difficulty-badge.easy {
            background: #4a7c59;
        }

        .difficulty-badge.medium {
            background: #c17f24;
        }

        .difficulty-badge.hard {
            background: #a63232;
        }

        @media (max-width: 900px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .card-description {
                display: none;
            }

            .card-image-container {
                height: 140px;
            }

            .card-content {
                padding: 0.75rem;
            }

            .card-actions {
                padding: 0.75rem;
                padding-top: 0;
                gap: 0.5rem;
            }

            .card-title {
                font-size: 0.85rem;
            }

            .card-price {
                font-size: 0.85rem;
                margin-top: 0.2rem;
            }

            .btn-style {
                padding: 0.6rem;
                font-size: 0.75rem;
            }
        }
    </style>
    <div class="product-card" data-category="{{ $product->productCategory }}"
        data-difficulty="{{ $product->productDifficulty }}" data-price="{{ $product->productPrice }}"
        data-rating="{{ $product->reviews_count > 0 ? round($product->reviews_avg_rating) : 0 }}">

        <div class="difficulty-badge {{ strtolower($product->productDifficulty) }}">
            {{ strtoupper($product->productDifficulty) }}
        </div>

        <a href="{{ route('product.index', $product->productSlug) }}" class="card-link-wrapper">
            <div class="card-image-container">
                @if ($product->productImage)
                    <img src="{{ $product->imageUrl }}" alt="{{ $product->productName }}">
                @else
                    <span class="placeholder-icon">🧩</span>
                @endif
            </div>

            <div class="card-content">
                <div class="card-header">
                    <h3 class="card-title">{{ $product->productName }}</h3>
                    <span class="card-price">£{{ number_format($product->productPrice, 2) }}</span>
                    <div class="card-rating">
                        <span class="card-stars-wrap">
                            <span class="stars-bg">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            <span class="stars-fg" data-pct="{{ $product->reviews_count > 0 ? (int)(($product->reviews_avg_rating / 5) * 100) : 0 }}">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        </span>
                        <span class="card-review-count">({{ $product->reviews_count ?? 0 }})</span>
                    </div>
                </div>

                <p class="card-description">
                    {{ $product->productDescription ?? 'Challenging puzzle awaiting your solution.' }}
                </p>

                <div class="card-meta">
                    <span class="meta-tag">{{ $product->productCategory }}</span>
                </div>
            </div>
        </a>

        <div class="card-actions">
            <form action="{{ route('basket.add') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="productID" value="{{ $product->productID }}">
                <button type="submit" class="btn-style btn-primary">
                    ADD TO BASKET
                </button>
            </form>
            <div class= "btn-wishlist">
                <form action="{{ route('wishlist.add') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="productID" value="{{ $product->productID }}">
                    <button type="submit" class="btn-style btn-secondary">
                        ADD TO WISHLIST
                    </button>
                </form>
            </div>

        </div>
    </div>
@endforeach
<script>
    document.querySelectorAll('.card-stars-wrap .stars-fg[data-pct]').forEach(function (el) {
        el.style.width = el.dataset.pct + '%';
    });
</script>