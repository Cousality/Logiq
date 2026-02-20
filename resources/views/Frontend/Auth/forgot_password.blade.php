<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
</head>

<body>
    @include('Frontend.components.nav')

    <main class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Forgot Password?</h2>
                <p>Enter your email address to receive a password reset link.</p>
            </div>

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form method="POST" action="{{ url('/send-reset-link') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <button type="submit" class="btn">Send Reset Link</button>

                <div class="auth-footer-link">
                    <a href="/login">Back to Login</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
