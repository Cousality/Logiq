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
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            flex: 1;
            justify-content: center;
            gap: 20px;
            padding: 0px 10% 50px;
        }

        .dashboard-card img {
            width: 300px;; 
        }

         
    </style>

</head>

<body>
    @include('Frontend.components.navbar')

<main>
    
    <div>
        <h1> Hello, 'user' </h1>
    </div>
    
    <section class="dashboard-containers">
        <div class="dashboard-card">
            <a href="your_orders"><img src="Images\your_orders.png" alt="Your Orders"></a>
        </div>
        
        <div class="dashboard-card">
            <a href="login&security"><img src="Images\login&security.png" alt="Login & Security"></a>
        </div>
        
        <div class="dashboard-card">
            <a href="login&security#your_address"><img src="Images\your_address.png" alt="Your Address"></a>
        </div>
        
        <div class="dashboard-card">
            <a href="exchange&returns"><img src="Images\exchange&returns.png" alt="Exchange & Returns"></a>
        </div>
        
        <div class="dashboard-card">
            <a href="customer_service"><img src="Images\customer_service.png" alt="Customer Service"></a>
        </div>
        
        <div class="dashboard-card">
            <a href="my_puzzles"><img src="Images\my_puzzles.png" alt="My Puzzles"></a>
        </div>
    </section>
    
</main>

@include('Frontend.components.footer')

</body>

</html>