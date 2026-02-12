<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
    <style>
        .forgot-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .forgot-container {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 10px 10px 0px var(--red-pastel-1);
        }

        .forgot-container h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
            text-align: center;
        }

        .forgot-container p {
            text-align: center;
            margin-bottom: 2.5rem;
            color: var(--text);
        }

        .success-message {
            background-color: #90EE90;
            color: var(--text);
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            text-align: center;
            border: 1px solid var(--text);
        }

        .forgot-container .btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--text);
            color: var(--white);
            border: none;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            text-transform: uppercase;
            transition:
                transform 0.2s,
                background-color 0.2s;
        }

        .forgot-container .btn:hover {
            transform: translateY(-3px);
            background-color: var(--red-pastel-2);
        }


        .forgot-container input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--text);
            color: var(--text);
            font-family: inherit;
            font-size: 1rem;
            margin-bottom: 1rem;
            transition: 0.2s;
        }

        .forgot-container input[type="email"]:focus {
            outline: none;
            border-color: var(--red-pastel-1);
            background: var(--white);
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .forgot-container .btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--text);
            color: var(--white);
            border: none;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            text-transform: uppercase;
            transition: transform 0.2s, background-color 0.2s;
        }

        .forgot-container .btn:hover {
            transform: translateY(-3px);
            background-color: var(--red-pastel-2);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--text);
            color: var(--red-pastel-1);
            font-weight: bold;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <main>
        <div class="forgot-wrapper">
            <div class="forgot-container">

                <h2>Forgot Password?</h2>
                <p>Enter your email address to receive a password reset link.</p>

                @if (session('message'))
                    <p class="success-message">{{ session('message') }}</p>
                @endif
                <div class="form-group">
                    <form method="POST" action="{{ url('/send-reset-link') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit" class="btn">Send Reset Link</button>
                    </form>
                </div>

                <a href="/login" class="back">Back to Login</a>
            </div>
        </div>
    </main>

</body>

</html>
