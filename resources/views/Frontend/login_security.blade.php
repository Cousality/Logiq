<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Security - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
        h1 {
            font-family: 'inria Serif';
            font-size: 40px;
            color: rgba(255, 255, 255, 100);
            text-align: center;
        }

        h2 {
            font-family: 'Inria Serif';
            font-size: 40px;
            color: #310E0E;
            margin: 0 0 10px 0;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .login_security_container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body>
    @include('Frontend.components.nav')
    <main>
        <div class="dashboard-layout">
            @include('Frontend.components.dashboard_sidebar')

            <div class="dashboard-content">
                <div class="page-header">
                    <h2 class="page-title">Login & Security</h2>
                    <p class="page-subtitle">Manage you name, email, phone number and password</p>
                </div>

    </main>

    @include('Frontend.components.footer')
</body>

</html
