<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lost - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        .error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 0 5%;
            text-align: center;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 40%);
        }

        .error-card {
            background: var(--white);
            padding: 3rem;
            border: 2px solid var(--text);
            max-width: 600px;
        }

        .error-code {
            font-size: 8rem;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 1rem;
            letter-spacing: -5px;
            color: var(--red-pastel-2);
        }

        .error-title {
            font-size: 2rem;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--text);
            padding-bottom: 1rem;
        }

        .error-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .back-button {
            display: inline-block;
            padding: 1rem 2.5rem;
            background-color: var(--text);
            color: var(--white);
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        .back-button:hover {
            transform: translate(0px, -3px);

        }

        @media (max-width: 768px) {
            .error-container {
                background: var(--bg-primary);
            }

            .error-code {
                font-size: 5rem;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <main class="error-container">
        <div class="error-card">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found.</h1>
            <p class="error-message">
                The page you are looking for does not exist.
            </p>
            <a href="{{ route('home') }}" class="back-button">Return to Homepage</a>
        </div>
    </main>

    @include('Frontend.components.footer')
</body>

</html>
