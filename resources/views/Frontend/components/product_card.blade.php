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

        .btn-brutalist {
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

        /* Badge Fix */
        .difficulty-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--text);
            color: var(--bg-primary);
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            font-weight: bold;
            border-left: 2px solid var(--text);
            border-bottom: 2px solid var(--text);
            z-index: 10;
        }
    </style>
    <div class="product-card" data-category="{{ $product->productCategory }}"
        data-difficulty="{{ $product->productDifficulty }}" data-price="{{ $product->productPrice }}">

        {{-- Difficulty Badge --}}
        <div class="difficulty-badge {{ strtolower($product->productDifficulty) }}">
            {{ strtoupper($product->productDifficulty) }}
        </div>

        <a href="{{ route('product.index', $product->productSlug) }}" class="card-link-wrapper">
            {{-- Image Area --}}
            <div class="card-image-container">
                @if ($product->productImage)
                    <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}">
                @else
                    <span class="placeholder-icon">🧩</span>
                @endif
            </div>

            {{-- Content Area --}}
            <div class="card-content">
                <div class="card-header">
                    <h3 class="card-title">{{ $product->productName }}</h3>
                    <span class="card-price">£{{ number_format($product->productPrice, 2) }}</span>
                </div>

                <p class="card-description">
                    {{ $product->productDescription ?? 'Challenging puzzle awaiting your solution.' }}
                </p>

                <div class="card-meta">
                    <span class="meta-tag">{{ $product->productCategory }}</span>
                </div>
            </div>
        </a>

        {{-- Action Buttons (Sticky Footer) --}}
        <div class="card-actions">
            <form action="{{ route('basket.add') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="productID" value="{{ $product->productID }}">
                <button type="submit" class="btn-brutalist btn-primary">
                    ADD TO BASKET
                </button>
            </form>

            <form action="{{ route('wishlist.add') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="productID" value="{{ $product->productID }}">
                <button type="submit" class="btn-brutalist btn-secondary">
                    ADD TO WISHLIST
                </button>
            </form>
        </div>
    </div>
@endforeach
