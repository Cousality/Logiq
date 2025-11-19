<!DOCTYPE html>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #4A1F1F;
    }

    .logo img {
        width: 250px;
    }

    #main-header {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        background-color: rgba(49, 14, 14, 100);
    }

    nav {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        flex: 1;
        justify-content: space-between;
        align-items: center;
    }

    nav a {
        padding: 0px;
        text-decoration: none;
        color: white;
    }

    .icon img {
        width: 75px;
    }

    .icon:hover {
        background: rgba(255, 255, 255, 1);
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 1;
        background-color: rgba(49, 14, 14, 1);
        min-width: 160px;
    }

    .dropdown-content a {
        color: white;
        padding: 12px 12px;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: rgba(76, 32, 32, 1);
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<header id="main-header">
    <div class="logo">
        <a href="/"><img src="{{ asset('Images/darker_logo.png') }}" alt="LOGIQ Logo"></a>
    </div>

    <nav>
        <div style="flex: 1; display: flex; justify-content: center;">
            @include('Frontend.components.searchbar')
        </div>
        <div style="display: flex; align-items: center; gap: 0;">
            <div class="dropdown">
                <a class="icon" href="login"><img src="{{ asset('Images/login_icon.png') }}" alt="login"></a>
                <div class="dropdown-content">
                    <a href="dashboard">Profile</a>
                    <a href="profile">Account Details</a>
                    <a href="profile">Your Orders</a>
                    <form action="{{ route('logout') }}" method = "POST">
                        @csrf
                        <button class="btn">logout</button>
                    </form>

                </div>
            </div>
            <a class="icon" href="wishlist"><img src="{{ asset('Images/favourites_icon.png') }}" alt="wishlist"></a>
            <a class="icon" href="basket"><img src="{{ asset('Images/basket_icon.png') }}" alt="basket"></a>
        </div>
    </nav>
</header>

</html>
