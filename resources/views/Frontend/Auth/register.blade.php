<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        .register-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 10px 10px 0px var(--red-pastel-1);
        }

        .register-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .register-header h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .alert {
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            text-align: center;
            border: 1px solid var(--text);
        }

        .alert-success {
            background-color: #90EE90;
            color: var(--text);
        }

        .alert-danger {
            background-color: var(--red-pastel-1);
            color: var(--bg-primary);
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
            text-align: left;
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

        .error {
            color: var(--red-pastel-1);
            font-size: 0.85rem;
            margin-top: 0.25rem;
            font-weight: bold;
        }

        .btn {
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

        .btn:hover {
            transform: translateY(-3px);
            background-color: var(--red-pastel-2);
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

    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <h2>Register</h2>
                <p>Create your account to get started.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
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
                    <input type="password" name="password" placeholder="••••••••" required>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Register</button>

                <p class="signup">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
