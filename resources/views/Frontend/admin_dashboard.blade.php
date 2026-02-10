<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <h1 class="dashboard-title"> Hello, Admin</h1>
        </header>

        <section class="dashboard-containers">
            <div class="dashboard-card">
                <a href="#"><img src="Images\order_management.png" alt="Order Management"></a>
            </div>

            <div class="dashboard-card">
                <a href="#"><img src="Images\user_management.png" alt="User Management"></a>
            </div>

            <div class="dashboard-card">
                <a href="#"><img src="Images\inventory_management.png" alt="Inventory Management"></a>
            </div>

            <div class="dashboard-card">
                <a href="#"><img src="Images\analytics_reports.png" alt="Analytics & Reports"></a>
            </div>

            <div class="dashboard-card">
                <a href="\admin_customer_service"><img src="Images\admin_customerService.png"
                        alt="Admin Customer Service"></a>
            </div>

            <div class="dashboard-card">
                <a href="#"><img src="Images\login_security.png" alt="Login & Security"></a>
            </div>
        </section>

    </main>

    @include('Frontend.components.footer')

</body>

</html>
