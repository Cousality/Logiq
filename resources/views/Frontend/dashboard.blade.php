<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
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

        .dashboard-subtitle {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        h2 {
            font-family: 'inria Serif';
            font-size: 25px;
            text-align: center;
        }

        .dashboard-containers {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            max-width: 1200px;
            margin: 0 auto;
            gap: 30px;
            padding: 0px 10% 50px;
        }

        .dashboard-card {
            width: 100%;
        }

        .dashboard-card img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* MOBILE */

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }
        }
    </style>

</head>

<body>
    @include('Frontend.components.nav')

    <main>

        <header class="dashboard-header">
            <h1 class="dashboard-title"> Hello, {{ auth()->check() ? auth()->user()->firstName : 'User' }}</h1>
        </header>

        <section class="dashboard-containers">
            <div class="dashboard-card">
                <a href="/your_orders"><img src="Images\your_orders.png" alt="Your Orders"></a>
            </div>

            <div class="dashboard-card">
                <a href="/login_security"><img src="Images\login_security.png" alt="Login & Security"></a>
            </div>

            <div class="dashboard-card">
                <a href="/your_address"><img src="Images\your_address.png" alt="Your Address"></a>
            </div>

            <div class="dashboard-card">
                <a href="/wishlist"><img src="Images\wishlist.png" alt="Wishlist"></a>
            </div>

            <div class="dashboard-card">
                <a href="/customer_service"><img src="Images\customer_service.png" alt="Customer Service"></a>
            </div>

            <div class="dashboard-card">
                <a href="/my_puzzles"><img src="Images\my_puzzles.png" alt="My Puzzles"></a>
            </div>
        </section>

    </main>

    @include('Frontend.components.footer')

</body>


</html>
