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
            text-transform: uppercase;
        }

        .dashboard-content {
            padding: 3rem 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* NAVIGATION */
        .back-nav {
            margin-bottom: 2rem;
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            padding: 10px 15px;
            text-decoration: none;
            border: 2px solid var(--text);
            display: inline-block;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* WISHLIST GRID & CARDS */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .wishlist-card {
            background: var(--white);
            border: 2px solid var(--text);
            display: flex;
            flex-direction: column;
            transition: all 0.2s ease;
        }

        .wishlist-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .product-image {
            width: 100%;
            height: 250px;
            background: var(--red-pastel-1);
            border-bottom: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-name {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--text);
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.3rem;
            color: var(--text);
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        /* BUTTONS */
        .add-to-basket {
            width: 100%;
            padding: 1rem;
            background: var(--text);
            color: var(--white);
            border: 2px solid var(--text);
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            font-family: inherit;
            transition: all 0.2s;
            margin-bottom: 0.75rem;
        }

        .add-to-basket:hover {
            background: var(--red-pastel-1);
            color: var(--white);
            border-color: var(--red-pastel-1);
        }

        .remove-from-wishlist {
            width: 100%;
            padding: 1rem;
            background: transparent;
            color: var(--text);
            border: 2px solid var(--text);
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
            font-family: inherit;
            transition: all 0.2s;
        }

        .remove-from-wishlist:hover {
            background: var(--text);
            color: var(--white);
        }

        /* EMPTY STATE */
        .empty-wishlist {
            text-align: center;
            padding: 5rem 2rem;
            background: var(--white);
            border: 2px solid var(--text);
        }

        .empty-wishlist h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .empty-wishlist p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        .empty-wishlist .cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--text);
            color: var(--white);
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            border: 2px solid var(--text);
            transition: transform 0.2s;
        }

        .empty-wishlist .cta-button:hover {
            transform: translateY(-3px);
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
        }

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')
    <header class="dashboard-header">
        <h1 class="dashboard-title">Your Wishlist.</h1>
        <p>View and manage your saved items.</p>
    </header>

    <main class="dashboard-content">
        <div class="back-nav">
            <a href="{{ route('dashboard') }}" class="btn-secondary">← Back to Dashboard</a>
        </div>

        <div class="wishlist-container">
            @if (!empty($wishlistItems) && count($wishlistItems) > 0)
                <div class="wishlist-grid">
                    @include('Frontend.components.wishlist_card')
                </div>
            @else
                <div class="empty-wishlist">
                    <h2>Your wishlist is empty.</h2>
                    <p>Nothing saved yet. Start exploring.</p>
                    <a href="{{ route('store.index') }}" class="cta-button">Continue Shopping</a>
                </div>
            @endif
        </div>
    </main>

    <script src="{{ asset('js/wishlistPage.js') }}"></script>

    @include('Frontend.components.footer')
</body>

</html>
