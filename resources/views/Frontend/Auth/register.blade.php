<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
</head>

<body>
    @include('Frontend.components.nav')

    <main class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Register</h2>
                <p>Create your account to get started.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="user@logiq.com" value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>First name</label>
                    <input type="text" name="fname" placeholder="Enter your first name" value="{{ old('fname') }}"
                        required>
                    @error('fname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Last name</label>
                    <input type="text" name="lname" placeholder="Enter your last name" value="{{ old('lname') }}"
                        required>
                    @error('lname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password')">Show</button>
                    </div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password_confirmation')">Show</button>
                    </div>
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Register</button>

                <div class="auth-footer-link">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </main>

    <script src="{{ asset('js/togglePassword.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("password_confirmation");
            const form = document.querySelector("form");

            function validatePassword() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords do not match");
                } else {
                    confirmPassword.setCustomValidity("");
                }
            }

            password.onchange = validatePassword;
            confirmPassword.onkeyup = validatePassword;

            form.addEventListener('submit', function(event) {
                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    alert("Passwords do not match!");
                }
            });
        });
    </script>
</body>

</html>
