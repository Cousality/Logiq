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

    .store-icon {
        background-image: var(--icon-store); 
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
        margin-left: 2rem;
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-left: 0px;
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
    }
</style>

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
        <a href="{{ route('store.index') }}" class="nav-icon store-icon" 
                        alt="store"></a>
        @if (Auth::check() && Auth::user()->admin == 1)
            <a href="{{ route('admin.dashboard') }}" class= "nav-icon login-icon"
                        alt="login"></a>
        @elseif (Auth::check() && Auth::user()->admin == 0)
            <a href="{{ route('dashboard') }}" class="nav-icon login-icon"
                        alt="login"></a>
        @else
            <a href="{{ route('login') }}" class="nav-icon login-icon"
                        alt="login"></a>
        @endif
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
    </div>
</nav>

<script>
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
</script>
