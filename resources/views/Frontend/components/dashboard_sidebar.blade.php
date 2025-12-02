<style>
    .dashboard-sidebar {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 250px;
        height: fit-content;
    }

    .sidebar-user-section {
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 20px;
    }

    .sidebar-greeting {
        font-size: 13px;
        color: #666;
        margin: 0 0 5px 0;
    }

    .sidebar-username {
        font-family: 'Inria Serif';
        font-size: 18px;
        font-weight: 600;
        color: #310E0E;
        margin: 0;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .sidebar-section {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    .sidebar-section-title {
        font-family: 'Inria Serif';
        font-size: 12px;
        font-weight: 600;
        color: #310E0E;
        margin-bottom: 10px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f0f0f0;
    }

    .sidebar-menu-item {
        margin-bottom: 2px;
    }

    .sidebar-menu-link {
        display: block;
        padding: 10px 12px;
        color: #555;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.2s;
        font-size: 14px;
    }

    .sidebar-menu-link:hover {
        background-color: #f5f5f5;
        color: #310E0E;
    }

    .sidebar-menu-link.active {
        background-color: #310E0E;
        color: white;
    }

    @media (max-width: 768px) {
        .dashboard-sidebar {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>

<aside class="dashboard-sidebar">
    <div class="sidebar-user-section">
        <p class="sidebar-greeting">Hello,</p>
        <p class="sidebar-username">{{ auth()->check() ? auth()->user()->firstName : 'User' }}</p>
    </div>

    <nav class="sidebar-menu">
        <div class="sidebar-section">
            <h3 class="sidebar-section-title">Account Settings</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li class="sidebar-menu-item">
                    <a href="{{ route('loginSecurity') }}"
                        class="sidebar-menu-link {{ request()->routeIs('loginSecurity') ? 'active' : '' }}">Login &
                        Security</a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('yourAddress') }}"
                        class="sidebar-menu-link {{ request()->routeIs('yourAddress') ? 'active' : '' }}">Your
                        Address</a>
                </li>
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-section-title">Orders & Activity</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard.orders') }}"
                        class="sidebar-menu-link {{ request()->routeIs('dashboard.orders') ? 'active' : '' }}"> Your
                        Orders </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('wishlist.index') }}"
                        class="sidebar-menu-link {{ request()->routeIs('wishlist.index') ? 'active' : '' }}"> My
                        Wishlist </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('basket.index') }}"
                        class="sidebar-menu-link {{ request()->routeIs('basket.index') ? 'active' : '' }}"> My Basket
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-section-title">My Puzzles</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li class="sidebar-menu-item">
                    <a href="{{ route('mypuzzles') }}"
                        class="sidebar-menu-link {{ request()->routeIs('mypuzzles') ? 'active' : '' }}">
                        My Puzzles
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-section-title">Support</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li class="sidebar-menu-item">
                    <a href="{{ route('customer_service') }}"
                        class="sidebar-menu-link {{ request()->routeIs('customer_service') ? 'active' : '' }}">
                        Customer Service
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</aside>
