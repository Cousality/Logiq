<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        h1 {
            font-family: 'inria Serif';
            font-size: 60px;
            color: rgba(255, 255, 255, 100);
            text-align: center;
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
    </style>

</head>

<body>
    @include('Frontend.components.navbar')

    <main>
        <div>
            <h1> Hello, {{ auth()->check() ? auth()->user()->firstName : 'User' }} </h1>
        </div>

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
