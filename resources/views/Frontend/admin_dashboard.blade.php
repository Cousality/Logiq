<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            <h1> Hello, Admin </h1>
        </div>

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
