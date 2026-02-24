<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Wishlist - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        /* HEADER */
        .dashboard-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .dashboard-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        /* LAYOUT */
        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .wishlist-container {
            flex: 1;
        }

        /* GRID */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        /* CARD */
        .wishlist-card {
            background: var(--white);
            border: 2px solid var(--text);
            transition: 0.3s;
        }

        .wishlist-card:hover {
            box-shadow: 6px 6px 0px var(--text);
        }

        .product-image {
            width: 100%;
            height: 180px;
            background: var(--bg-secondary);
            border-bottom: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 1rem;
        }

        .product-name {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.4rem;
        }

        .product-price {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .add-to-basket {
            width: 100%;
            padding: 0.6rem;
            background: var(--text);
            color: var(--text-light);
            border: 2px solid var(--text);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.2s;
            margin-bottom: 0.5rem;
        }

        .add-to-basket:hover {
            background: var(--red-pastel-2);
            border-color: var(--red-pastel-2);
        }

        .remove-from-wishlist {
            width: 100%;
            padding: 0.6rem;
            background: transparent;
            color: var(--text);
            border: 2px solid var(--text);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.2s;
        }

        .remove-from-wishlist:hover {
            background: var(--red-pastel-1);
            color: var(--text-light);
            border-color: var(--red-pastel-1);
        }

        /* EMPTY STATE */
        .empty-wishlist {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            text-align: center;
        }

        .empty-wishlist a {
            color: var(--text);
            font-weight: bold;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; padding: 20px 5%; }
            .wishlist-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">My Wishlist</h1>
        <p>View and manage your saved items.</p>
    </header>

    <div class="dashboard-layout">
        @include('Frontend.components.dashboard_sidebar')

        <main class="wishlist-container">
            @if (!empty($wishlistItems) && count($wishlistItems) > 0)
                <div class="wishlist-grid">
                    @include('Frontend.components.wishlist_card')
                </div>
            @else
                <div class="empty-wishlist">
                    <p style="margin-bottom: 0.5rem;">Your wishlist is empty.</p>
                    <p><a href="{{ route('store.index') }}">Continue Shopping</a></p>
                </div>
            @endif
        </main>
    </div>

    <script src="{{ asset('js/wishlistPage.js') }}"></script>
    @include('Frontend.components.footer')
</body>

</html>
