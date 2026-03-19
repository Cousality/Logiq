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

            <form method="POST" action="{{ route('register.submit') }}" novalidate>
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                        name="email"
                        placeholder="user@logiq.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- First Name -->
                <div class="form-group">
                    <label>First name</label>
                    <input type="text"
                        name="fname"
                        placeholder="Enter your first name"
                        value="{{ old('fname') }}"
                        pattern="[A-Za-z\s'-]+"
                        title="Only letters, spaces, apostrophes, and hyphens allowed"
                        autocomplete="given-name"
                        required>
                    @error('fname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label>Last name</label>
                    <input type="text"
                        name="lname"
                        placeholder="Enter your last name"
                        value="{{ old('lname') }}"
                        pattern="[A-Za-z\s'-]+"
                        title="Only letters, spaces, apostrophes, and hyphens allowed"
                        autocomplete="family-name"
                        required>
                    @error('lname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password"
                            name="password"
                            id="password"
                            placeholder="Enter password"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}"
                            title="Must include uppercase, lowercase, number, special character and be at least 8 characters"
                            autocomplete="new-password"
                            required>

                        <button type="button"
                            class="password-toggle"
                            onclick="togglePassword('password')">Show</button>
                    </div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="Confirm password"
                            autocomplete="new-password"
                            required>

                        <button type="button"
                            class="password-toggle"
                            onclick="togglePassword('password_confirmation')">Show</button>
                    </div>
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn" id="submitBtn">Register</button>

                <div class="auth-footer-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </div>

            </form>
        </div>
    </main>

    <script src="{{ asset('js/togglePassword.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("password_confirmation");
            const form = document.querySelector("form");

            const nameInputs = document.querySelectorAll('input[name="fname"], input[name="lname"]');

            // Prevent numbers in names (live)
            nameInputs.forEach(input => {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/[^A-Za-z\s'-]/g, '');
                });
            });

            // Password match validation
            function validatePassword() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords do not match");
                } else {
                    confirmPassword.setCustomValidity("");
                }
            }

            password.addEventListener("change", validatePassword);
            confirmPassword.addEventListener("keyup", validatePassword);

            // Final submit check
            form.addEventListener('submit', function (event) {

                // Trim names
                nameInputs.forEach(input => {
                    input.value = input.value.trim();
                });

                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    alert("Passwords do not match!");
                }
            });

        });
    </script>

</body>
</html>