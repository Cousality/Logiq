<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        /* add Sign in through google */
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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            color: var(--text);
            font-family: inherit;
            font-size: 1rem;
            transition: 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--red-pastel-1);
            background: var(--white);
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        }

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

        .signup {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            border-top: 1px solid var(--text);
            padding-top: 1.5rem;
        }

        .signup a {
            color: var(--red-pastel-1);
            font-weight: bold;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
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
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">LOGIN</button>

                <p class="signup">
                    New here? <a href="{{ route('register') }}">Create Account</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
