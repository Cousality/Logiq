<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
    <style>
        .forgot {
            float: right;
            font-size: 0.8rem;
            color: var(--red-pastel-1);
            text-decoration: none;
            font-weight: bold;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .error-message {
            background-color: var(--red-pastel-1);
            color: var(--bg-primary);
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            text-align: center;
            border: 1px solid var(--text);
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h1>LOGIN</h1>
                <p>Enter your credentials to continue.</p>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                @if ($errors->has('credentials'))
                    <div class="error-message">
                        {{ $errors->first('credentials') }}
                    </div>
                @endif

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="user@logiq.com" required autofocus>
                </div>

                <div class="form-group">
                    <a href="/forgot-password" class="forgot">Forgot Password?</a>
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password')">Show</button>
                    </div>
                </div>

                <button type="submit" class="btn">LOGIN</button>

                <p class="auth-footer-link">
                    New here? <a href="{{ route('register') }}">Create Account</a>
                </p>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/togglePassword.js') }}"></script>

</body>


</html>
