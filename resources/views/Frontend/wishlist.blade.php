<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Wishlist</title>
    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .dashboard-content {
            flex: 1;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-family: 'Inria Serif';
            font-size: 40px;
            color: #310E0E;
            margin: 0 0 10px 0;
        }

        .page-subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .wishlist-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .wishlist-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: 0.2s;
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
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

        .remove-from-wishlist {
            width: 100%;
            padding: 0.75rem;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: bold;
            transition: 0.2s;
        }

        .remove-from-wishlist:hover {
            background: #c82333;
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
            margin-bottom: 0.5rem;
        }

        .add-to-basket:hover {
            background: #562323;
        }

        .empty-wishlist {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-wishlist a {
            color: #310E0E;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .dashboard-layout {
                flex-direction: column;
            }

            .wishlist-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <div class="dashboard-layout">
        @include('Frontend.components.dashboard_sidebar')

        <main class="dashboard-content">
            <div class="page-header">
                <h1 class="page-title">My Wishlist</h1>
                <p class="page-subtitle">View and manage your saved items</p>
            </div>

            <div class="wishlist-container">
                @if (!empty($wishlistItems) && count($wishlistItems) > 0)
                    <div class="wishlist-grid">
                        @include('Frontend.components.wishlist_card')
                    </div>
                @else
                    <div class="empty-wishlist">
                        <p>Your wishlist is empty.</p>
                        <p><a href="{{ route('store.index') }}">Continue Shopping</a></p>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <script src="{{ asset('js/wishlistPage.js') }}"></script>

    @include('Frontend.components.footer')
</body>

</html>
