<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

</head>

<body>
    @include('Frontend.components.nav')

    <main>
        <div class="forgot-wrapper">
            <div class="forgot-container">

                <h2>Forgot Password?</h2>
                <p>Enter your email address to receive a password reset link.</p>

                {{-- SUCCESS MESSAGE --}}
                @if (session('message'))
                    <p class="success-message">{{ session('message') }}</p>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ url('/send-reset-link') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn">Send Reset Link</button>
                </form>

                <a href="/login" class="back">Back to Login</a>
            </div>
        </div>
    </main>

</body>

</html>
