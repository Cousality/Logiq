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
            <a href="/"><img src="Images\darker_logo.png" alt="LOGIQ Logo"></a>
        </div>
        
        <nav>
            <a class="icon" href="search"><img src="Images\search_icon.png" alt="search"></a>
             <div class="dropdown">
                <a class="icon" href="login"><img src="Images\login_icon.png" alt="login"></a>
                <div class="dropdown-content">
                    <a href="profile">Profile</a>
                    <form action="<?php echo e(route('logout')); ?>" method = "POST">
                        <?php echo csrf_field(); ?>
                        <button class="btn">logout</button>
                    </form>
                    
                </div>
            </div>
            <a class="icon" href="favourites"><img src="Images\favourites_icon.png" alt="favourites"></a>
            <a class="icon" href="basket"><img src="Images\basket_icon.png" alt="basket"></a>
        </nav>
    </header>
</html><?php /**PATH C:\Users\ianhj\Documents\github\Logiq\Backend\resources\views/Frontend/components/navbar.blade.php ENDPATH**/ ?>