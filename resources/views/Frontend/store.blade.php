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
            position: sticky;
            top: 2rem;
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
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--text);
            color: var(--bg-primary);
        }

        select.filter-btn {
            appearance: auto;
        }

        /* PRODUCTS */
        .store-products {
            flex: 1;
            min-width: 0;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
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
                flex: none;
                width: 100%;
                position: static;
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
                    <button class="filter-btn active category-filter" data-filter="all">ALL</button>
                    <button class="filter-btn category-filter" data-filter="Twist">TWIST PUZZLE</button>
                    <button class="filter-btn category-filter" data-filter="Jigsaw">JIGSAWS</button>
                    <button class="filter-btn category-filter" data-filter="Word&Number">WORD & NUMBER</button>
                    <button class="filter-btn category-filter" data-filter="BoardGames">BOARD GAMES</button>
                    <button class="filter-btn category-filter" data-filter="HandheldBrainTeasers">HANDHELD</button>
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
