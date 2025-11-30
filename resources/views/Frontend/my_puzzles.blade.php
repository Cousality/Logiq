<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Puzzles - LOGIQ</title>

    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
            font-family: Inria Serif, serif;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .dashboard-content {
            flex: 1;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .page-header h2 {
            font-size: 40px;
            color: rgba(49,14,14,1);
            margin: 0;
        }

        .category-block {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .category-block h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: rgba(49,14,14,1);
        }

        .puzzle-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            row-gap: 10px;
            padding-left: 20px;
        }

        .puzzle-item {
            font-size: 18px;
        }

        @media (max-width: 700px) {
            .puzzle-list {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>

<body>

@include('Frontend.components.navbar')

<main>
    <div class="dashboard-layout">

        @include('Frontend.components.dashboard_sidebar')

        <div class="dashboard-content">

            <div class="page-header">
                <h2>My Puzzles</h2>
                <p class="page-subtitle">View and edit reviewed and rated orders</p>
            </div>

        </div>
    </div>
</main>

@include('Frontend.components.footer')

</body>
</html>
