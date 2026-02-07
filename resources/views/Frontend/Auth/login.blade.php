<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

</head>

<body>
    @include('Frontend.components.nav')


    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <a href="/forgot-password" class="forgot">Forgot?</a>
            <input type="text" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        @if ($errors->has('credentials'))
            <div class="error-message" style="
        color: #b30000;
        font-weight: 600;">
                {{ $errors->first('credentials') }}
            </div>
        @endif


        <button type="submit" class="btn">Sign In</button>
        <p class="signup">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
    </form>
    </div>
    </div>
</body>

</html>
