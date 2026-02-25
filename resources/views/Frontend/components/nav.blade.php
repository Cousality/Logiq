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
        border-bottom: 1px solid var(--text);
        padding-bottom: 5px;
    }

    .search-icon {
        font-size: 1.2rem;
        margin-right: 10px;
        opacity: 0.6;
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

    .nav-btn {
        background: var(--text);
        color: var(--bg-primary);
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        font-family: inherit;
        font-weight: bold;
        margin-left: 1rem;
    }

    #dark-mode-toggle {
        background: var(--text);
        color: var(--bg-primary);
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        font-family: inherit;
        font-weight: bold;
        margin-left: 1rem;
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
        font-family: inherit;
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
        padding: 0;
        margin: 0;
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

    /* Mobile Fixes for Nav */
    @media (max-width: 768px) {
        nav {
            flex-direction: column;
            gap: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .search-container {
            width: 100%;
            margin: 0;
        }

        .nav-links a {
            margin: 0 10px;
        }

        .category-sidebar {
            width: 100%;
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

    <div class="search-container">
        <span class="search-icon">⌕</span>
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query" class="search-input" placeholder="Search puzzles..." required />
            <button type="submit" style="opacity: 0; width: 0; height: 0; position: absolute;"></button>
        </form>
    </div>

    <div class="nav-links">
        @auth
            <a href="{{ route('dashboard') }}" class="nav-icon login-icon" alt="login"></a>
        @else
            <a href="{{ route('login') }}" class="nav-icon login-icon" alt="login"></a>
        @endauth
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
        </div>
        @auth
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-btn">LOGOUT</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">LOGIN</a>
        @endguest

        <button id="dark-mode-toggle">THEME</button>

        <!-- Hamburger — far right -->
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Open categories" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<script>
    // Dark mode toggle
    const toggleBtn = document.getElementById("dark-mode-toggle");
    const body = document.body;

    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
    }

    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("dark-mode");
        localStorage.setItem(
            "theme",
            body.classList.contains("dark-mode") ? "dark" : "light",
        );
    });

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
</script>
