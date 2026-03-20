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

            <form method="POST" action="{{ route('password.update') }}" onsubmit="return validateForm()">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
                </div>

                <!-- Password match message -->
                <p id="matchMessage" style="margin-top: 10px;"></p>

                <button type="submit" class="btn">Reset Password</button>

                <div class="auth-footer-link">
                    <a href="/login">Back to Login</a>
                </div>
            </form>
        </div>
    </main>

    <!-- Password match script -->
    <script>
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="password_confirmation"]');
        const message = document.getElementById('matchMessage');

        function checkPasswords() {
            if (confirmPassword.value === "") {
                message.textContent = "";
                return;
            }

            if (password.value === confirmPassword.value) {
                message.textContent = "Passwords match";
                message.style.color = "green";
            } else {
                message.textContent = "Passwords do not match";
                message.style.color = "red";
            }
        }

        function validateForm() {
            if (password.value !== confirmPassword.value) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }

        password.addEventListener("input", checkPasswords);
        confirmPassword.addEventListener("input", checkPasswords);
    </script>
</body>

</html>
