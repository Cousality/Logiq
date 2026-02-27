<style>
    /* Navigation Styles */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 5%;
        background: var(--bg-primary);
        border-bottom: 1px solid var(--text);
    }

    .logo {
        font-size: 2rem;
        font-weight: 900;
        letter-spacing: -2px;
        border: 2px solid var(--text);
        padding: 5px 15px;
        flex-shrink: 0;
    }

    .logo a {
        color: inherit;
        text-decoration: none;
    }

    .search-container {
        flex: 1;
        max-width: 400px;
        margin: 0 2rem;
        display: flex;
        align-items: center;
        border-bottom: 2px solid transparent;
        box-shadow: 0 1px 0 0 var(--text);
        padding-bottom: 5px;
        transition: box-shadow 0.2s ease;
        position: relative;
    }

    .search-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        right: 0;
        background: var(--bg-primary);
        border: 1px solid var(--text);
        z-index: 9999;
        max-height: 360px;
        overflow-y: auto;
    }

    .search-dropdown.open {
        display: block;
    }

    .search-dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 1rem;
        text-decoration: none;
        color: var(--text);
        border-bottom: 1px solid rgba(0,0,0,0.06);
        transition: background 0.15s ease;
    }

    .search-dropdown-item:last-child {
        border-bottom: none;
    }

    .search-dropdown-item:hover,
    .search-dropdown-item.focused {
        background: var(--bg-secondary);
    }

    .search-dropdown-thumb {
        width: 42px;
        height: 42px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid var(--text);
    }

    .search-dropdown-thumb-placeholder {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        background: var(--bg-secondary);
        border: 1px solid var(--text);
    }

    .search-dropdown-info {
        flex: 1;
        min-width: 0;
    }

    .search-dropdown-name {
        font-weight: 600;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .search-dropdown-price {
        font-size: 0.8rem;
        opacity: 0.65;
        margin-top: 2px;
    }

    .search-dropdown-footer {
        padding: 0.6rem 1rem;
        font-size: 0.82rem;
        text-align: center;
        opacity: 0.6;
        border-top: 1px solid var(--text);
        cursor: pointer;
    }

    .search-dropdown-footer:hover {
        opacity: 1;
        background: var(--bg-secondary);
    }

    .search-dropdown-empty {
        padding: 1rem;
        text-align: center;
        font-size: 0.9rem;
        opacity: 0.55;
    }

    .search-container:focus-within {
        box-shadow: 0 2px 0 0 var(--red-pastel-1);
    }

    .search-container:focus-within .search-icon {
        opacity: 1;
    }

    .search-icon {
        font-size: 1.2rem;
        margin-right: 10px;
        opacity: 0.6;
        transition: opacity 0.2s ease;
    }

    .search-container form {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .search-input {
        width: 100%;
        background: transparent;
        border: none;
        outline: none;
        color: var(--text);
        font-size: 1rem;
        font-family: inherit;
    }

    .search-input::placeholder {
        color: var(--text);
        opacity: 0.5;
    }

    .search-container button {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
    }
    
    .nav-icon {
        width: 50px;           
        height: 50px;
        display: flex;         
        align-items: center;  
        justify-content: center;
        background-size: contain;
        cursor: pointer;
    }

    .login-icon {
        background-image: var(--icon-login); 
    }

    .basket-icon {
        background-image: var(--icon-basket);
    }

    .nav-links {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        gap: 10px;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    /* Account Dropdown */
    .account-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .account-dropdown {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 420px;
        background: var(--bg-primary);
        border: 2px solid var(--text);
        z-index: 900;
        opacity: 0;
        pointer-events: none;
        transform: translateY(-6px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .account-dropdown.open {
        opacity: 1;
        pointer-events: all;
        transform: translateY(0);
    }

    /* Bridge the gap so cursor doesn't fall into empty space */
    .account-dropdown::before {
        content: '';
        position: absolute;
        top: -14px;
        left: 0;
        right: 0;
        height: 14px;
    }

    .dropdown-header {
        padding: 1rem 1.4rem 0.9rem;
        border-bottom: 2px solid var(--text);
    }

    .dropdown-greeting {
        display: block;
        font-size: 0.7rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0.5;
        margin-bottom: 2px;
    }

    .dropdown-name {
        display: block;
        font-size: 1.2rem;
        font-weight: 900;
        letter-spacing: -0.5px;
        text-transform: uppercase;
    }

    /* Wide multi-column body */
    .dropdown-columns {
        display: flex;
        border-bottom: 2px solid var(--text);
    }

    .dropdown-col {
        flex: 1;
        padding: 0.8rem 0 1rem;
        border-right: 1px solid var(--bg-secondary);
    }

    .dropdown-col:last-child {
        border-right: none;
    }

    .dropdown-col-title {
        font-size: 0.65rem;
        font-weight: bold;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0.5;
        padding: 0.2rem 1.2rem 0.6rem;
        border-bottom: 1px solid var(--bg-secondary);
        margin-bottom: 0.3rem;
    }

    .dropdown-col a {
        display: block;
        padding: 0.4rem 1.2rem;
        color: var(--text);
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: background 0.15s;
    }

    .dropdown-col a:hover {
        background: var(--bg-secondary);
    }

    /* Guest state (no columns needed) */
    .dropdown-guest {
        display: flex;
        border-bottom: 2px solid var(--text);
    }

    .dropdown-guest a {
        flex: 1;
        display: block;
        padding: 1rem 1.2rem;
        color: var(--text);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center;
        border-right: 1px solid var(--text);
        transition: background 0.15s;
    }

    .dropdown-guest a:last-child {
        border-right: none;
    }

    .dropdown-guest a:hover {
        background: var(--bg-secondary);
    }

    .dropdown-actions {
        display: flex;
    }

    .dropdown-actions button,
    .dropdown-actions a {
        flex: 1;
        background: var(--text);
        color: var(--bg-primary);
        border: none;
        padding: 0.7rem 0.5rem;
        cursor: pointer;
        font-family: inherit;
        font-weight: bold;
        font-size: 0.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-decoration: none;
        text-align: center;
        transition: opacity 0.15s;
    }

    .dropdown-actions form {
        flex: 1;
        display: flex;
        border-right: 1px solid var(--bg-primary);
    }

    .dropdown-actions button:hover,
    .dropdown-actions a:hover,
    .dropdown-actions form button:hover {
        opacity: 0.8;
    }

    /* Basket Dropdown */
    .basket-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .basket-dropdown {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 360px;
        background: var(--bg-primary);
        border: 2px solid var(--text);
        z-index: 900;
        opacity: 0;
        pointer-events: none;
        transform: translateY(-6px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .basket-dropdown.open {
        opacity: 1;
        pointer-events: all;
        transform: translateY(0);
    }

    /* Bridge the gap so cursor doesn't fall into empty space */
    .basket-dropdown::before {
        content: '';
        position: absolute;
        top: -14px;
        left: 0;
        right: 0;
        height: 14px;
    }

    .basket-preview-items {
        max-height: 280px;
        overflow-y: auto;
        border-bottom: 2px solid var(--text);
        margin-top: 1px;
    }

    .basket-preview-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.2rem;
        border-bottom: 1px solid var(--bg-secondary);
    }

    .basket-preview-item:last-child {
        border-bottom: none;
    }

    .basket-preview-img {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border: 1px solid var(--bg-secondary);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
    }

    .basket-preview-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .basket-preview-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        min-width: 0;
    }

    .basket-preview-name {
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .basket-preview-qty {
        font-size: 0.72rem;
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .basket-preview-price {
        font-size: 0.85rem;
        font-weight: bold;
        flex-shrink: 0;
    }

    .basket-preview-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1.2rem;
        border-bottom: 2px solid var(--text);
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .basket-preview-empty {
        padding: 1.5rem 1.2rem;
        text-align: center;
        font-size: 0.82rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.5;
        border-bottom: 2px solid var(--text);
    }

    .basket-dropdown .dropdown-actions a:not(:last-child) {
        border-right: 1px solid var(--bg-primary);
    }

    /* Hamburger Button */
    .hamburger-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 36px;
        height: 36px;
        padding: 0;
        margin-left: 1rem;
        flex-shrink: 0;
    }

    .hamburger-btn span {
        display: block;
        width: 24px;
        height: 2px;
        background: var(--text);
    }

    /* Sidebar Overlay */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(74, 44, 42, 0.35);
        z-index: 998;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.open {
        opacity: 1;
        pointer-events: all;
    }

    /* Category Sidebar */
    .category-sidebar {
        position: fixed;
        top: 0;
        right: 0;
        width: 280px;
        height: 100vh;
        background: var(--bg-primary);
        border-left: 2px solid var(--text);
        z-index: 999;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        will-change: transform;
    }

    .category-sidebar.open {
        transform: translateX(0);
    }

    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 2px solid var(--text);
    }

    .sidebar-title {
        font-size: 1.1rem;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .sidebar-close {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        color: var(--text);
        font-weight: bold;
        line-height: 1;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
    }

    .sidebar-close:hover {
        background: var(--text);
        color: var(--bg-primary);
    }

    .sidebar-section-label {
        font-size: 0.7rem;
        font-weight: bold;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0.6;
        padding: 1.2rem 1.5rem 0.5rem;
        border-bottom: 1px solid var(--text);
    }

    .sidebar-category-list {
        list-style: none;
    }

    .sidebar-category-list li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.85rem 1.5rem;
        text-decoration: none;
        color: var(--text);
        font-size: 0.9rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid var(--bg-secondary);
        transition: background 0.2s;
    }

    .sidebar-category-list li a:hover {
        background: var(--bg-secondary);
    }

    .sidebar-category-list li a svg {
        width: 16px;
        height: 16px;
        stroke: var(--text);
        stroke-width: 2.5;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        opacity: 0.5;
        flex-shrink: 0;
        transition: transform 0.2s, opacity 0.2s;
    }

    .sidebar-category-list li a:hover svg {
        opacity: 1;
        transform: translateX(4px) scale(1.2);
    }

    .sidebar-category-list li:last-child a {
        border-bottom: none;
    }

    .sidebar-store-link {
        margin: 1.5rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid var(--text);
    }

    .sidebar-store-link a {
        display: block;
        text-align: center;
        padding: 0.75rem 1rem;
        background: var(--text);
        color: var(--bg-primary);
        text-decoration: none;
        font-weight: bold;
        font-size: 0.85rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: opacity 0.2s;
    }

    .sidebar-store-link a:hover {
        opacity: 0.85;
    }

    /* Mobile Account Modal */
    .mobile-account-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(74, 44, 42, 0.55);
        z-index: 1000;
        align-items: flex-end;
        justify-content: center;
    }

    .mobile-account-overlay.active {
        display: flex;
    }

    .mobile-account-box {
        background: var(--bg-primary);
        border-top: 2px solid var(--text);
        border-left: none;
        border-right: none;
        border-bottom: none;
        width: 100%;
        position: relative;
    }

    .mobile-account-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.2rem 1.5rem;
        border-bottom: 2px solid var(--text);
    }

    .mobile-account-header span {
        font-size: 1rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .mobile-account-close {
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

    .mobile-account-btn {
        display: block;
        width: 100%;
        padding: 0.9rem 1.5rem;
        border: none;
        background: var(--bg-primary);
        color: var(--text);
        font-family: 'Courier New', monospace;
        font-weight: 900;
        font-size: 0.9rem;
        line-height: 1.4;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s;
        box-sizing: border-box;
    }

    .mobile-account-btn:hover {
        background: var(--bg-secondary);
    }

    .mobile-account-btn.danger {
        color: var(--red-pastel-1);
    }

    .mobile-account-items > * {
        display: block;
        margin: 0;
        border-bottom: 1px solid var(--bg-secondary);
    }

    .mobile-account-items > *:last-child {
        border-bottom: none;
    }

    /* Mobile Fixes for Nav */
    @media (max-width: 900px) {
        nav {
            flex-wrap: wrap;
            gap: 0.75rem;
            padding: 1rem 5%;
        }

        .logo {
            order: 1;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .nav-links {
            order: 2;
            margin-left: auto;
        }

        .search-container {
            order: 3;
            flex-basis: 100%;
            width: 100%;
            max-width: 100%;
            margin: 0;
        }

        .nav-links a {
            margin: 0 4px;
        }

        .category-sidebar {
            width: 100%;
        }

        .account-dropdown {
            width: calc(100vw - 10%);
            right: 0;
        }

        .basket-dropdown {
            width: calc(100vw - 10%);
            right: 0;
        }
    }
</style>

<!-- Category sidebar overlay -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>

<!-- Category sidebar -->
<aside class="category-sidebar" id="category-sidebar" aria-label="Categories">
    <div class="sidebar-header">
        <span class="sidebar-title">Browse</span>
        <button class="sidebar-close" id="sidebar-close" aria-label="Close categories">&#215;</button>
    </div>

    <p class="sidebar-section-label">Categories</p>

    <ul class="sidebar-category-list">
        <li>
            <a href="{{ route('store.index') }}">
                All Products
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </li>
        <li>
            <a href="{{ route('store.index') }}?category=Twist">
                Twist Puzzles
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </li>
        <li>
            <a href="{{ route('store.index') }}?category=Jigsaw">
                Jigsaws
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </li>
        <li>
            <a href="{{ route('store.index') }}?category=Word%26Number">
                Word &amp; Number
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </li>
        <li>
            <a href="{{ route('store.index') }}?category=BoardGames">
                Board Games
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </li>
        <li>
            <a href="{{ route('store.index') }}?category=HandheldBrainTeasers">
                Handheld Brain Teasers
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </li>
    </ul>

    <div class="sidebar-store-link">
        <a href="{{ route('store.index') }}">View Full Store</a>
    </div>
</aside>

<nav>
    <div class ="logo">
        <a href="{{ route('home') }}">LOGIQ.</a>
    </div>

    <div class="search-container" id="search-wrapper">
        <span class="search-icon">⌕</span>
        <form action="{{ route('search') }}" method="GET" id="search-form">
            <input
                type="text"
                name="query"
                id="search-input"
                class="search-input"
                placeholder="Search puzzles..."
                autocomplete="off"
                required
            />
            <button type="submit" style="opacity: 0; width: 0; height: 0; position: absolute;"></button>
        </form>
        <div class="search-dropdown" id="search-dropdown"></div>
    </div>

    <div class="nav-links">
        <!-- Account icon with dropdown -->
        <div class="account-wrapper">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-icon login-icon" alt="account"></a>
            @else
                <a href="{{ route('login') }}" class="nav-icon login-icon" alt="login"></a>
            @endauth

            <div class="account-dropdown">
                @auth
                    <div class="dropdown-header">
                        <span class="dropdown-greeting">Hello,</span>
                        <span class="dropdown-name">{{ auth()->user()->firstName }}</span>
                    </div>

                    <div class="dropdown-columns">
                        <div class="dropdown-col">
                            <p class="dropdown-col-title">Your Account</p>
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <a href="{{ route('dashboard.orders') }}">Your Orders</a>
                            <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                            <a href="{{ route('mypuzzles') }}">My Puzzles</a>
                        </div>
                        <div class="dropdown-col">
                            <p class="dropdown-col-title">Settings</p>
                            <a href="{{ route('loginSecurity') }}">Login &amp; Security</a>
                            <a href="{{ route('yourAddress') }}">Your Address</a>
                            <a href="{{ route('customer_service') }}">Customer Service</a>
                        </div>
                        @if(auth()->user()->admin == 1)
                            <div class="dropdown-col">
                                <p class="dropdown-col-title">Admin</p>
                                <a href="{{ route('userManagement') }}">User Management</a>
                                <a href="{{ route('admin.products.index') }}">Inventory</a>
                                <a href="{{ route('admin.customer_service') }}">Support Tickets</a>
                            </div>
                        @endif
                    </div>

                    <div class="dropdown-actions">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                        <button id="dark-mode-toggle" type="button">Theme</button>
                    </div>
                @else
                    <div class="dropdown-guest">
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                    <div class="dropdown-actions">
                        <button id="dark-mode-toggle" type="button">Theme</button>
                    </div>
                @endauth
            </div>
        </div>
        <div class="basket-wrapper">
            <a href="{{ route('basket.index') }}" 
               class="nav-icon basket-icon"
               alt="basket">
            </a>

            @if(($basketCount ?? 0) > 0)
                <span class="basket-badge" id="basket-count">
                    {{ $basketCount }}
                </span>
            @endif

            <div class="basket-dropdown">
                <div class="dropdown-header">
                    <span class="dropdown-greeting">Your Basket</span>
                    <span class="dropdown-name">{{ $basketCount ?? 0 }} Item{{ ($basketCount ?? 0) != 1 ? 's' : '' }}</span>
                </div>

                @if(($basketCount ?? 0) > 0)
                    <div class="basket-preview-items">
                        @foreach($basketPreviewItems ?? [] as $item)
                            <div class="basket-preview-item">
                                <div class="basket-preview-img">
                                    @if(!empty($item->product->productImage))
                                        <img src="{{ $item->product->productImage }}" alt="{{ $item->product->productName }}">
                                    @endif
                                </div>
                                <div class="basket-preview-info">
                                    <span class="basket-preview-name">{{ $item->product->productName }}</span>
                                    <span class="basket-preview-qty">Qty: {{ $item->quantity }}</span>
                                </div>
                                <span class="basket-preview-price">£{{ number_format($item->product->productPrice * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="basket-preview-total">
                        <span>Total</span>
                        <span>£{{ number_format($basketTotal ?? 0, 2) }}</span>
                    </div>
                @else
                    <div class="basket-preview-empty">
                        <span>Your basket is empty</span>
                    </div>
                @endif

                <div class="dropdown-actions">
                    <a href="{{ route('basket.index') }}">View Basket</a>
                    @if(($basketCount ?? 0) > 0)
                        <a href="{{ route('checkout.index') }}">Checkout</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Hamburger — far right -->
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Open categories" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<!-- Mobile Account Modal -->
<div class="mobile-account-overlay" id="mobile-account-overlay">
    <div class="mobile-account-box">
        <div class="mobile-account-header">
            @auth
                <span>Hello, {{ auth()->user()->firstName }}</span>
            @else
                <span>Account</span>
            @endauth
            <button class="mobile-account-close" id="mobile-account-close" aria-label="Close">&times;</button>
        </div>

        @auth
            <div class="mobile-account-items">
                <a href="{{ route('dashboard') }}" class="mobile-account-btn">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="mobile-account-btn danger">Logout</button>
                </form>
                <button class="mobile-account-btn" id="mobile-theme-bar">Toggle Theme</button>
            </div>
        @else
            <div class="mobile-account-items">
                <a href="{{ route('login') }}" class="mobile-account-btn">Login</a>
                <a href="{{ route('register') }}" class="mobile-account-btn">Register</a>
                <button class="mobile-account-btn" id="mobile-theme-bar">Toggle Theme</button>
            </div>
        @endauth
    </div>
</div>

<script>
    // Dark mode toggle (desktop)
    const toggleBtn = document.getElementById("dark-mode-toggle");
    const body = document.body;

    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
    }

    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            body.classList.toggle("dark-mode");
            localStorage.setItem("theme", body.classList.contains("dark-mode") ? "dark" : "light");
        });
    }

    // Mobile theme toggle (inside modal)
    const mobileThemeToggle = document.getElementById('mobile-theme-bar');
    if (mobileThemeToggle) {
        mobileThemeToggle.addEventListener('click', () => {
            body.classList.toggle("dark-mode");
            localStorage.setItem("theme", body.classList.contains("dark-mode") ? "dark" : "light");
        });
    }

    function openAccountModal() {
        mobileAccountOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAccountModal() {
        mobileAccountOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Mobile account modal
    const mobileAccountOverlay = document.getElementById('mobile-account-overlay');
    const mobileAccountClose = document.getElementById('mobile-account-close');
    const accountIcon = document.querySelector('.account-wrapper .nav-icon');

    if (accountIcon && mobileAccountOverlay) {
        accountIcon.addEventListener('click', (e) => {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                openAccountModal();
            }
        });
    }

    if (mobileAccountClose) {
        mobileAccountClose.addEventListener('click', () => closeAccountModal());
    }

    if (mobileAccountOverlay) {
        mobileAccountOverlay.addEventListener('click', (e) => {
            if (e.target === mobileAccountOverlay) closeAccountModal();
        });
    }

    // Account dropdown
    const accountWrapper = document.querySelector('.account-wrapper');
    const accountDropdown = document.querySelector('.account-dropdown');

    if (accountWrapper && accountDropdown) {
        let closeTimer;
        accountWrapper.addEventListener('mouseenter', () => {
            if (window.innerWidth <= 900) return;
            clearTimeout(closeTimer);
            accountDropdown.classList.add('open');
        });
        accountWrapper.addEventListener('mouseleave', () => {
            if (window.innerWidth <= 900) return;
            closeTimer = setTimeout(() => accountDropdown.classList.remove('open'), 50);
        });
    }

    // Basket dropdown
    const basketWrapper = document.querySelector('.basket-wrapper');
    const basketDropdown = document.querySelector('.basket-dropdown');

    if (basketWrapper && basketDropdown) {
        let basketCloseTimer;
        basketWrapper.addEventListener('mouseenter', () => {
            if (window.innerWidth <= 900) return;
            clearTimeout(basketCloseTimer);
            basketDropdown.classList.add('open');
        });
        basketWrapper.addEventListener('mouseleave', () => {
            if (window.innerWidth <= 900) return;
            basketCloseTimer = setTimeout(() => basketDropdown.classList.remove('open'), 50);
        });
    }

    // Category sidebar toggle
    const hamburgerBtn = document.getElementById("hamburger-btn");
    const categorySidebar = document.getElementById("category-sidebar");
    const sidebarOverlay = document.getElementById("sidebar-overlay");
    const sidebarClose = document.getElementById("sidebar-close");

    function openSidebar() {
        categorySidebar.classList.add("open");
        sidebarOverlay.classList.add("open");
        hamburgerBtn.setAttribute("aria-expanded", "true");
        document.body.style.overflow = "hidden";
    }

    function closeSidebar() {
        categorySidebar.classList.remove("open");
        sidebarOverlay.classList.remove("open");
        hamburgerBtn.setAttribute("aria-expanded", "false");
        document.body.style.overflow = "";
    }

    hamburgerBtn.addEventListener("click", () => {
        categorySidebar.classList.contains("open") ? closeSidebar() : openSidebar();
    });

    sidebarClose.addEventListener("click", closeSidebar);
    sidebarOverlay.addEventListener("click", closeSidebar);

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeSidebar();
    });

    // ── Live search dropdown ──────────────────────────────────────────────
    const searchInput    = document.getElementById('search-input');
    const searchDropdown = document.getElementById('search-dropdown');
    const searchForm     = document.getElementById('search-form');
    const suggestionsUrl = "{{ route('search.suggestions') }}";

    let focusedIndex = -1;

    function getItems() {
        return searchDropdown.querySelectorAll('.search-dropdown-item');
    }

    function setFocus(index) {
        const items = getItems();
        items.forEach(el => el.classList.remove('focused'));
        if (index >= 0 && index < items.length) {
            items[index].classList.add('focused');
            items[index].scrollIntoView({ block: 'nearest' });
        }
        focusedIndex = index;
    }

    function openDropdown(html) {
        searchDropdown.innerHTML = html;
        searchDropdown.classList.add('open');
        focusedIndex = -1;
    }

    function closeDropdown() {
        searchDropdown.classList.remove('open');
        searchDropdown.innerHTML = '';
        focusedIndex = -1;
    }

    function buildDropdownHtml(suggestions, query) {
        if (suggestions.length === 0) {
            return `<div class="search-dropdown-empty">No results found</div>`;
        }
        const items = suggestions.map(s => {
            const thumb = s.image
                ? `<img class="search-dropdown-thumb" src="${s.image}" alt="${s.name}" />`
                : `<div class="search-dropdown-thumb-placeholder"></div>`;
            return `<a class="search-dropdown-item" href="/product/${s.slug}">
                ${thumb}
                <div class="search-dropdown-info">
                    <div class="search-dropdown-name">${s.name}</div>
                    <div class="search-dropdown-price">£${s.price}</div>
                </div>
            </a>`;
        }).join('');
        const footer = `<div class="search-dropdown-footer" data-query="${query}">See all results for "${query}"</div>`;
        return items + footer;
    }

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim();
        if (query.length === 0) {
            closeDropdown();
            return;
        }
        fetch(`${suggestionsUrl}?query=${encodeURIComponent(query)}`)
            .then(r => r.json())
            .then(data => {
                if (searchInput.value.trim() === '') { closeDropdown(); return; }
                openDropdown(buildDropdownHtml(data, query));

                // "See all results" footer click
                const footer = searchDropdown.querySelector('.search-dropdown-footer');
                if (footer) {
                    footer.addEventListener('click', () => {
                        searchForm.submit();
                    });
                }
            })
            .catch(() => closeDropdown());
    });

    // Keyboard navigation
    searchInput.addEventListener('keydown', (e) => {
        if (!searchDropdown.classList.contains('open')) return;
        const items = getItems();
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            setFocus(Math.min(focusedIndex + 1, items.length - 1));
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            setFocus(Math.max(focusedIndex - 1, 0));
        } else if (e.key === 'Enter') {
            if (focusedIndex >= 0 && items[focusedIndex]) {
                const href = items[focusedIndex].getAttribute('href');
                if (href) { e.preventDefault(); window.location.href = href; }
            }
        } else if (e.key === 'Escape') {
            closeDropdown();
        }
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!document.getElementById('search-wrapper').contains(e.target)) {
            closeDropdown();
        }
    });
</script>
