<style>
    .dashboard-sidebar {
        background: var(--white);
        border: 2px solid var(--text);
        padding: 20px;
        width: 250px;
        height: fit-content;
    }

    .sidebar-user-section {
        padding-bottom: 15px;
        border-bottom: 2px solid var(--text);
        margin-bottom: 20px;
    }

    .sidebar-greeting {
        font-size: 13px;
        opacity: 0.6;
        margin: 0 0 5px 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .sidebar-username {
        font-size: 18px;
        font-weight: bold;
        color: var(--text);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-section {
        margin-bottom: 16px;
        width: 100%;
    }

    .sidebar-section-title {
        font-size: 11px;
        font-weight: bold;
        color: var(--text);
        margin-bottom: 4px;
        padding-bottom: 4px;
        border-bottom: 1px solid var(--text);
        text-transform: uppercase;
        letter-spacing: 1px;
        width: 100%;
    }

    .sidebar-menu-item {
        width: 100%;
    }

    .sidebar-menu-link {
        display: block;
        padding: 6px 8px;
        color: var(--text);
        text-decoration: none;
        transition: background 0.2s;
        font-size: 14px;
    }

    .sidebar-menu-link:hover {
        background-color: var(--bg-secondary);
    }

    .sidebar-menu-link.active {
        background-color: var(--text);
        color: var(--text-light);
        font-weight: bold;
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
        <p class="sidebar-username">{{ auth()->check() ? auth()->user()->firstName : 'Admin' }}</p>
    </div>

    <div class="sidebar-menu">
        <div class="sidebar-section">
            <h3 class="sidebar-section-title">Users</h3>
            <ul style="list-style: none; padding: 0; margin: 0; width: 100%;">
                <li class="sidebar-menu-item">
                    <a href="#"
                        class="sidebar-menu-link">
                        Order Management
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('userManagement') }}"
                        class="sidebar-menu-link {{ request()->routeIs('userManagement') ? 'active' : '' }}">
                        User Management
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-section-title">Store</h3>
            <ul style="list-style: none; padding: 0; margin: 0; width: 100%;">
                <li class="sidebar-menu-item">
                    <a href="{{ route('inventory_management') }}"
                        class="sidebar-menu-link {{ request()->routeIs('inventory_management') ? 'active' : '' }}">
                        Inventory
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('promotions') }}"
                        class="sidebar-menu-link {{ request()->routeIs('promotions') ? 'active' : '' }}">
                        Promotions
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#"
                        class="sidebar-menu-link">
                        Analytics & Reports
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-section-title">Support</h3>
            <ul style="list-style: none; padding: 0; margin: 0; width: 100%;">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.customer_service') }}"
                        class="sidebar-menu-link {{ request()->routeIs('admin.customer_service') ? 'active' : '' }}">
                        Support Tickets
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
