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

        .dashboard-containers {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            max-width: 1300px;
            margin: 0 auto;
            gap: 30px;
            padding: 50px 10% 0px;
        }

        .dashboard-card {
            background: var(--white);
            border: 2px solid var(--text);
            box-shadow: 0px 0px 0px var(--text);
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            position: relative;
        }

        .card-link-wrapper {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .dashboard-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .card-title {
            padding-top: 40px;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
        }

        .card-description {
            font-size: 15px;
            padding: 10px 20px 0px;
            margin-bottom: 40px;
            text-align: center;
            opacity: 0.8;
        }

        /* MOBILE */

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .dashboard-containers {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

</head>

<body>
    @include('Frontend.components.nav')

    <main>

        @if (Auth::check() && Auth::user()->admin == 1)
        <header class="dashboard-header">
            <h1 class="dashboard-title"> Hello, Admin</h1>
            <p>Welcome to your dashboard.</p>
        </header>

        <section class="dashboard-containers">
            <div class="dashboard-card">
                <a href="#" class="card-link-wrapper">
                    <h3 class= "card-title">Order Management</h3>
                    <h3 class="card-description">View, check and process customer orders.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="#" class="card-link-wrapper">
                    <h3 class= "card-title">User Management</h3>
                    <h3 class="card-description">View, add, delete and update customer details.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="#" class="card-link-wrapper">
                    <h3 class= "card-title">Inventory Management</h3>
                    <h3 class="card-description">Manage stock levels and add, edit or remove products.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="#" class="card-link-wrapper">
                    <h3 class= "card-title">Analytics & Reports</h3>
                    <h3 class="card-description">View current reports on stock levels and processing orders.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="/admin_customer_service" class="card-link-wrapper">
                    <h3 class= "card-title">Customer Service</h3>
                    <h3 class="card-description">View and respond to customer form requests.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="#" class="card-link-wrapper">
                    <h3 class= "card-title">Login & Security</h3>
                    <h3 class="card-description">Manage name, email, phone number and password.</h3>
                </a>
            </div>
        </section>

        @else (Auth::check() && Auth::user()->admin == 0)
        <header class="dashboard-header">
            <h1 class="dashboard-title"> Hello, {{ auth()->check() ? auth()->user()->firstName : 'User' }}</h1>
            <p>Welcome to your dashboard.</p>
        </header>

        <section class="dashboard-containers">
            <div class="dashboard-card">
                <a href="/your_orders" class="card-link-wrapper">
                    <h3 class= "card-title">Your Orders</h3>
                    <h3 class="card-description">View, manage and check status of past orders.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="/login_security" class="card-link-wrapper">
                    <h3 class= "card-title">Login & Security</h3>
                    <h3 class="card-description">Manage name, email and password.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="/your_address" class="card-link-wrapper">
                    <h3 class= "card-title">Your Address</h3>
                    <h3 class="card-description">Add, edit or remove an address.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="/wishlist" class="card-link-wrapper">
                    <h3 class= "card-title">Wishlist</h3>
                    <h3 class="card-description">View and manage saved products.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="/customer_service" class="card-link-wrapper">
                    <h3 class= "card-title">Customer Service</h3>
                    <h3 class="card-description">Use the contact form to contact us.</h3>
                </a>
            </div>

            <div class="dashboard-card">
                <a href="/my_puzzles" class="card-link-wrapper">
                    <h3 class= "card-title">My Puzzles</h3>
                    <h3 class="card-description">View and edit reviewed and rated orders.</h3>
                </a>
            </div>
        </section>
        @endif

    </main>

    @include('Frontend.components.footer')

</body>

</html>
