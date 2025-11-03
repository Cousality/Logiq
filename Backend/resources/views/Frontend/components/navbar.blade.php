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
            flex-wrap:wrap;
            flex-direction: row;
            flex: 1;
            justify-content: right;
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

    </style>
    <header id="main-header">
        <div class="logo">
            <a href="/"><img src="Images\darker_logo.png" alt="LOGIQ Logo"></a>
        </div>
        
        <nav>
            <a class="icon" href="search"><img src="Images\search_icon.png" alt="search"></a>
            <a class="icon" href="login"><img src="Images\login_icon.png" alt="login"></a>
            <a class="icon" href="favourites"><img src="Images\favourites_icon.png" alt="favourites"></a>
            <a class="icon" href="basket"><img src="Images\basket_icon.png" alt="basket"></a>
        </nav>
    </header>
</html>