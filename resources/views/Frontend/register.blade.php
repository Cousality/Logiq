<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - LOGIQ</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 100px);
            background-color: #4A1F1F;
        }


        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .logo {
            margin-bottom: 25px;
        }

        .logo img {
            width: 120px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .social-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .social-buttons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48%;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        .facebook {
            background: #3b5998;
        }

        .google {
            background: #db4437;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .forgot {
            font-size: 13px;
            color: #4A1F1F;
            text-decoration: none;
            float: right;
        }

        .btn {
            background: #4A1F1F;
            color: #fff;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3b1919;
        }

        .signup {
            margin-top: 15px;
            font-size: 14px;
        }

        .signup a {
            color: #4A1F1F;
            text-decoration: none;
            font-weight: 500;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')
    <div class = "login-wrapper">
        <div class="login-container">
            <div class="logo">
                <img src="{{ asset('Images/logo.png') }}" alt="LOGIQ Logo">
            </div>
            <h2>Register</h2>

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
                    <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
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
                    <input type="password" name="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Register</button>

            </form>
        </div>
    </div>
</body>
@include('Frontend.components.footer')

</html>
