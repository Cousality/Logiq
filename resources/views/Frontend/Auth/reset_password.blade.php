<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - LOGIQ</title>

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />

    <style>
        .login-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 10px 10px 0px var(--red-pastel-1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .btn-login {
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
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            background-color: var(--red-pastel-2);
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

        .success-message {
            background-color: #d4edda;
            color: #155724;
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

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-header">
                <h1>RESET PASSWORD</h1>
                <p>Enter your new password below.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request('email') }}">

                {{-- Global Errors --}}
                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- New Password --}}
                <div class="form-group">
                    <label>New Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password"
                            placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password')">Show</button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password_confirmation"
                            id="password_confirmation" placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password_confirmation')">Show</button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    RESET PASSWORD
                </button>

            </form>

        </div>
    </div>

    <script src="{{ asset('js/togglePassword.js') }}"></script>

</body>

</html>