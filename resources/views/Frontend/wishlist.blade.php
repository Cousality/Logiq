<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Wishlist</title>
    <style>
        .content-wrapper {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        h1 {
            color: white;
            font-family: 'Inria Serif';
            text-align: center;
            margin-bottom: 2rem;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            color: white;
            font-size: 1.2rem;
        }

        .empty-wishlist a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <div class="content-wrapper">
        <h1>My Wishlist</h1>

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

    <script src="{{ asset('js/wishlistPage.js') }}"></script>

</body>
@include('Frontend.components.footer')

</html>
