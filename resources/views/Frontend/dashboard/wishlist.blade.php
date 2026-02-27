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
            min-width: 0;
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
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .wishlist-card:hover {
            transform: translate(-4px, -4px);
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
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-name {
            font-size: 1.4rem;
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
        @media (max-width: 900px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; padding: 20px 5%; }
            .wishlist-container { width: 100%; }
            .wishlist-grid { grid-template-columns: 1fr; }
            .wishlist-card { display: flex; flex-direction: row; }
            .product-image {
                width: 120px;
                min-width: 120px;
                height: auto;
                border-bottom: none;
                border-right: 2px solid var(--text);
            }
            .product-info { padding: 1rem; }
            .product-name { font-size: 1.1rem; }
        }

        /* REMOVE MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(74, 44, 42, 0.55);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: var(--bg-primary);
            border: 2px solid var(--text);
            padding: 2.5rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 6px 6px 0px var(--text);
            position: relative;
        }

        .modal-box h2 {
            font-size: 1.4rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .modal-message {
            font-size: 0.95rem;
            opacity: 0.75;
            margin: 1rem 0 2rem;
            line-height: 1.6;
            font-style: italic;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            font-size: 1.4rem;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text);
            font-weight: bold;
            line-height: 1;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
        }

        .modal-confirm-btn,
        .modal-cancel-btn {
            flex: 1;
            padding: 0.85rem;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--text);
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .modal-confirm-btn {
            background: var(--text);
            color: var(--bg-primary);
        }

        .modal-confirm-btn:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
            color: var(--white);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--text);
        }

        .modal-cancel-btn {
            background: var(--bg-primary);
            color: var(--text);
        }

        .modal-cancel-btn:hover {
            background: var(--bg-secondary);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--text);
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

    {{-- REMOVE FROM WISHLIST MODAL --}}
    <div class="modal-overlay" id="removeWishlistModal">
        <div class="modal-box">
            <button class="modal-close" id="removeWishlistClose" aria-label="Close">&times;</button>
            <h2>Remove from Wishlist?</h2>
            <p class="modal-message" id="removeWishlistMessage"></p>
            <div class="modal-actions">
                <button type="button" class="modal-confirm-btn" id="removeWishlistConfirm">Yes, Remove It</button>
                <button type="button" class="modal-cancel-btn" id="removeWishlistCancel">Keep It</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/wishlistPage.js') }}"></script>
    @include('Frontend.components.footer')
</body>

</html>
