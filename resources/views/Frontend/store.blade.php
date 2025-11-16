<!DOCTYPE html>

<head>
    <style>
        .content-wrapper {
            display: flex;
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .sidebar {
            flex: 0 0 200px;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .sidebar h2 {
            color: #310E0E;
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .filter-option input[type="checkbox"] {
            cursor: pointer;
        }

        .products-container {
            flex: 1;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .product-card.hidden {
            display: none;
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 0.9rem;
        }

        .product-info {
            padding: 1rem;
        }

        .product-name {
            font-size: 1rem;
            font-weight: bold;
            color: #310E0E;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .add-to-basket {
            width: 100%;
            padding: 0.75rem;
            background: #310E0E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-to-basket:hover {
            background: #562323;
        }

        .db-error-message {
            color: white;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: #666;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <div class="content-wrapper">
        <aside class="sidebar">
            <h2>Filter by Category</h2>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox" class="category-filter" value="Twist">
                    Twist Puzzle
                </label>
                <label class="filter-option">
                    <input type="checkbox" class="category-filter" value="Jigsaw">
                    Jigsaws
                </label>
                <label class="filter-option">
                    <input type="checkbox" class="category-filter" value="Word&Number">
                    Word & Number
                </label>
                <label class="filter-option">
                    <input type="checkbox" class="category-filter" value="BoardGames">
                    Board Games
                </label>
                <label class="filter-option">
                    <input type="checkbox" class="category-filter" value="HandheldBrainTeaser">
                    Handheld Brain Teasers
                </label>
            </div>
            <h2>Filter by Difficulty</h2>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox" class="difficulty-filter" value="easy">
                    Easy
                </label>
                <label class="filter-option">
                    <input type="checkbox" class="difficulty-filter" value="medium">
                    Medium
                </label>
                <label class="filter-option">
                    <input type="checkbox" class="difficulty-filter" value="hard">
                    Hard
                </label>
            </div>
        </aside>

        <div class="products-container">
            @if (!empty($dbError))
                <div class="db-error-message">
                    <h2>Cannot Connect to Database</h2>
                    <p>We're experiencing technical difficulties connecting to our product database.</p>
                </div>
            @else
                <div class="products-grid">
                    @include('Frontend.components.product_card')
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/storeFilter.js') }}"></script>

</body>
@include('Frontend.components.footer')

</html>
