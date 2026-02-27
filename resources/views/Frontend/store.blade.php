<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Store - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        /* STORE HEADER */
        .store-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .store-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        /* STORE LAYOUT */
        .store-layout {
            display: flex;
            align-items: flex-start;
            padding: 2rem 5%;
            gap: 2rem;
            margin-bottom: 5rem;
        }

        /* SIDEBAR */
        .filter-sidebar {
            flex: 0 0 200px;
            align-self: flex-start;
            background: var(--bg-secondary);
            border: 1px solid var(--text);
            padding: 1.5rem 1rem;
        }

        .filter-section {
            margin-bottom: 1.75rem;
        }

        .filter-section:last-child {
            margin-bottom: 0;
        }

        .filter-heading {
            font-size: 0.7rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.6;
            margin-bottom: 0.75rem;
            border-bottom: 1px solid var(--text);
            padding-bottom: 0.4rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-btn {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            color: var(--text);
            font-family: inherit;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            text-transform: uppercase;
            font-size: 0.8rem;
            text-align: left;
            text-decoration: none;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--text);
            color: var(--bg-primary);
        }

        select.filter-btn {
            appearance: auto;
        }

        /* PRICE SLIDER */
        .price-slider-wrapper {
            position: relative;
            height: 28px;
            margin: 0.5rem 0 0.25rem;
        }

        .price-slider-wrapper input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            position: absolute;
            width: 100%;
            height: 4px;
            background: transparent;
            pointer-events: none;
            outline: none;
            top: 50%;
            transform: translateY(-50%);
        }

        .price-slider-track {
            position: absolute;
            height: 4px;
            top: 50%;
            transform: translateY(-50%);
            left: 0;
            right: 0;
            background: var(--bg-primary);
            border: 1px solid var(--text);
        }

        .price-slider-range {
            position: absolute;
            height: 4px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--text);
        }

        .price-slider-wrapper input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 14px;
            height: 14px;
            background: var(--bg-primary);
            border: 2px solid var(--text);
            cursor: pointer;
            pointer-events: all;
        }

        .price-slider-wrapper input[type="range"]::-moz-range-thumb {
            width: 14px;
            height: 14px;
            background: var(--bg-primary);
            border: 2px solid var(--text);
            cursor: pointer;
            pointer-events: all;
            border-radius: 0;
        }

        .price-range-labels {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            font-weight: bold;
            margin-top: 0.25rem;
        }

        /* PRODUCTS */
        .store-products {
            flex: 1;
            min-width: 0;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 900px) {
            .store-title {
                font-size: 2.5rem;
            }

            .store-header {
                background: var(--bg-primary);
            }

            .store-layout {
                flex-direction: column;
                padding: 1.5rem 5%;
            }

            .filter-sidebar {
                position: static;
                flex: none;
                width: 100%;
                max-height: none;
            }

            .filter-group {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .filter-btn {
                width: auto;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
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

            .card-title {
                font-size: 0.9rem;
            }

            .card-price {
                font-size: 0.9rem;
                margin-top: 0.25rem;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="store-header">
        <h1 class="store-title">THE STORE.</h1>
        @if (isset($searchQuery) && $searchQuery)
            <p style="margin-top: 1rem; font-size: 1rem; opacity: 0.9;">
                Showing results for: "{{ $searchQuery }}" ({{ count($products) }} found)
            </p>
        @else
            <p> Logic Puzzles & More. </p>
        @endif
    </header>

    <div class="store-layout">
        <!-- Left Filter Sidebar -->
        <aside class="filter-sidebar">
            <div class="filter-section">
                <h3 class="filter-heading">Category</h3>
                <div class="filter-group">
                    <a href="{{ route('store.index') }}" class="filter-btn category-filter {{ !request('category') ? 'active' : '' }}">ALL</a>
                    <a href="{{ route('store.index') }}?category=Twist" class="filter-btn category-filter {{ request('category') === 'Twist' ? 'active' : '' }}">TWIST PUZZLE</a>
                    <a href="{{ route('store.index') }}?category=Jigsaw" class="filter-btn category-filter {{ request('category') === 'Jigsaw' ? 'active' : '' }}">JIGSAWS</a>
                    <a href="{{ route('store.index') }}?category=Word%26Number" class="filter-btn category-filter {{ request('category') === 'Word&Number' ? 'active' : '' }}">WORD & NUMBER</a>
                    <a href="{{ route('store.index') }}?category=BoardGames" class="filter-btn category-filter {{ request('category') === 'BoardGames' ? 'active' : '' }}">BOARD GAMES</a>
                    <a href="{{ route('store.index') }}?category=HandheldBrainTeasers" class="filter-btn category-filter {{ request('category') === 'HandheldBrainTeasers' ? 'active' : '' }}">HANDHELD</a>
                </div>
            </div>
            <div class="filter-section">
                <h3 class="filter-heading">Price Range</h3>
                <div class="price-slider-wrapper">
                    <div class="price-slider-track"></div>
                    <div class="price-slider-range" id="price-slider-range"></div>
                    <input type="range" id="price-min" min="0" max="200" value="0" step="1">
                    <input type="range" id="price-max" min="0" max="200" value="200" step="1">
                </div>
                <div class="price-range-labels">
                    <span id="price-min-label">£0</span>
                    <span id="price-max-label">£200</span>
                </div>
            </div>
            <div class="filter-section">
                <h3 class="filter-heading">Difficulty</h3>
                <div class="filter-group">
                    <select class="filter-btn" id="difficulty-filter">
                        <option value="all">ALL DIFFICULTIES</option>
                        <option value="easy">EASY</option>
                        <option value="medium">MEDIUM</option>
                        <option value="hard">HARD</option>
                    </select>
                </div>
            </div>
            <div class="filter-section">
                <h3 class="filter-heading">Min. Rating</h3>
                <div class="filter-group">
                    <select class="filter-btn" id="rating-filter">
                        <option value="0">ALL RATINGS</option>
                        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733; 5 Stars</option>
                        <option value="4">&#9733;&#9733;&#9733;&#9733; 4+ Stars</option>
                        <option value="3">&#9733;&#9733;&#9733; 3+ Stars</option>
                        <option value="2">&#9733;&#9733; 2+ Stars</option>
                    </select>
                </div>
            </div>
            <div class="filter-section">
                <h3 class="filter-heading">Sort By</h3>
                <div class="filter-group">
                    <select class="filter-btn" id="sort-by">
                        <option value="featured">FEATURED</option>
                        <option value="price-low">PRICE: LOW TO HIGH</option>
                        <option value="price-high">PRICE: HIGH TO LOW</option>
                    </select>
                </div>
            </div>
        </aside>

        <!-- Products Grid -->
        <section class="store-products">
            @if (!empty($dbError))
                <div class="db-error-message"
                    style="text-align: center; padding: 3rem; background: var(--red-pastel-1); color: var(--text-light); border: 2px solid var(--text);">
                    <h2 style="margin-bottom: 1rem; font-size: 2rem;">Cannot Connect to Database</h2>
                    <p>We're experiencing technical difficulties connecting to our product database.</p>
                </div>
            @else
                <div class="products-grid">
                    @include('Frontend.components.product_card')
                </div>

                <div class="no-results" style="display: none; text-align: center; padding: 3rem; font-size: 1.2rem;">
                    No products match your current filters.
                </div>
            @endif
        </section>
    </div>

    @include('Frontend.components.footer')

    <script src="{{ asset('js/storeFilter.js') }}"></script>
    <script src="{{ asset('js/wishlist.js') }}"></script>


</body>

</html>
