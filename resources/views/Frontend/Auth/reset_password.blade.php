<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
</head>

<body>
    @include('Frontend.components.nav')

    <main class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Reset Password</h2>
                <p>Enter your new password below.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
                </div>

                <button type="submit" class="btn">Reset Password</button>

                <div class="auth-footer-link">
                    <a href="/login">Back to Login</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>