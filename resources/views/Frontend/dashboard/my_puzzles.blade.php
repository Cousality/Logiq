<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Puzzles - LOGIQ</title>
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

        .dashboard-content {
            flex: 1;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .myPuzzles-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            box-shadow: 10px 10px 0px var(--red-pastel-1);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }

        .empty-puzzles {
            text-align:center; 
            padding: 50px 0; 
            color: var(--text);
        }

        /* MOBILE */

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .dashboard-layout {
                flex-direction: column;
            }
        }

    </style>

</head>

<body>
     @include('Frontend.components.nav')
    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">My Puzzles</h1>
            <p>View and edit reviewed and rated orders.</p>
        </header>

        <div class="dashboard-layout">
            @include('Frontend.components.dashboard_sidebar')
            <div class="dashboard-content">
                <div class="myPuzzles-container">
                    <h2 class="section-title">Your Past Reviews & Ratings</h2>
                    
                    <div class="empty-puzzles">
                        <h3>No reviewed puzzles found</h3>
                        <p>Once you leave a review, it will show up here.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('Frontend.components.footer')
</body>

</html
