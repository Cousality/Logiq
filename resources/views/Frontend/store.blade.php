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

        .store-subtitle {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .store-products {
            padding: 2rem 5%;
            margin-bottom: 5rem;
        }

        /* FILTERS */
        .filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 5%;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--text);
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-btn {
            padding: 0.5rem 1.5rem;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            color: var(--text);
            font-family: inherit;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--text);
            color: var(--bg-primary);
        }

        select.filter-btn {
            padding: 0.5rem 1rem;
        }




        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
        }

        .empty-state h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .store-title {
                font-size: 2.5rem;
            }

            .store-header {
                background: var(--bg-primary);
            }

            .filters {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                flex-wrap: wrap;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .featured-banner {
                grid-template-columns: 1fr;
                padding: 2rem;
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
            <p> Logic Puzzles & More </p>
        @endif
    </header>

    <div class="filters">
        <div class="filter-group">
            <button class="filter-btn active category-filter" data-filter="all">ALL</button>
            <button class="filter-btn category-filter" data-filter="Twist">TWIST PUZZLE</button>
            <button class="filter-btn category-filter" data-filter="Jigsaw">JIGSAWS</button>
            <button class="filter-btn category-filter" data-filter="Word&Number">WORD & NUMBER</button>
            <button class="filter-btn category-filter" data-filter="BoardGames">BOARD GAMES</button>
            <button class="filter-btn category-filter" data-filter="HandheldBrainTeasers">HANDHELD</button>
        </div>
        <div class="filter-group">
            <select class="filter-btn" id="difficulty-filter">
                <option value="all">ALL DIFFICULTIES</option>
                <option value="easy">EASY</option>
                <option value="medium">MEDIUM</option>
                <option value="hard">HARD</option>
            </select>
            <select class="filter-btn" id="sort-by">
                <option value="featured">FEATURED</option>
                <option value="price-low">PRICE: LOW TO HIGH</option>
                <option value="price-high">PRICE: HIGH TO LOW</option>
            </select>
        </div>
    </div>

    <!-- Products Grid -->
    <section class="store-products">
        @if (!empty($dbError))
            <div class="db-error-message"
                style="text-align: center; padding: 3rem; background: var(--red-pastel-1); color: var(--text-light); border: 2px solid var(--text); margin: 0 5%;">
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

    @include('Frontend.components.footer')

    <script src="{{ asset('js/storeFilter.js') }}"></script>
    <script src="{{ asset('js/wishlist.js') }}"></script>

    <script>
        // Category filter functionality
        const categoryFilterBtns = document.querySelectorAll('.category-filter');
        const productCards = document.querySelectorAll('.product-card');
        const difficultyFilter = document.getElementById('difficulty-filter');
        const sortBy = document.getElementById('sort-by');
        const noResults = document.querySelector('.no-results');

        let activeCategory = 'all';
        let activeDifficulty = 'all';

        // Category button filters
        categoryFilterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryFilterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                activeCategory = btn.dataset.filter;
                applyFilters();
            });
        });

        // Difficulty filter
        difficultyFilter.addEventListener('change', (e) => {
            activeDifficulty = e.target.value;
            applyFilters();
        });

        // Apply all filters
        function applyFilters() {
            let visibleCount = 0;

            productCards.forEach(card => {
                const category = card.dataset.category;
                const difficulty = card.dataset.difficulty;

                let showCategory = activeCategory === 'all' || category === activeCategory;
                let showDifficulty = activeDifficulty === 'all' || difficulty === activeDifficulty;

                if (showCategory && showDifficulty) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Sort functionality
        if (sortBy) {
            sortBy.addEventListener('change', (e) => {
                const sortValue = e.target.value;
                const grid = document.querySelector('.products-grid');
                const cards = Array.from(productCards);

                cards.sort((a, b) => {
                    if (sortValue === 'price-low') {
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    } else if (sortValue === 'price-high') {
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    }
                    return 0;
                });

                cards.forEach(card => grid.appendChild(card));
            });
        }
    </script>
</body>

</html>
