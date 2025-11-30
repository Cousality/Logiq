<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account - LOGIQ</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }


        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #4A1F1F;
            padding: 40px 0;
        }



        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            width: 400px;
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

        .google {
            background: #ffffff
        }

        .social-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-content: center;
            justify-content: center;
        }

        .social-buttons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48%;
            padding: 10px;
            border-radius: 5px;
            color: black;
            text-decoration: none;
            font-weight: 500;
        }

        .google {
            background: #db4437;
            border: 2px solid black;

        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
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
    </style>
</head>

<body>
    @include('Frontend.components.navbar')
    <main>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="logo">
                <img src="Images\logo.png" alt="LOGIQ Logo">
            </div>
            <h2>Sign In With</h2>
            <div class="social-buttons">
                <a href="#" class="google">Google</a>
            </div>

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
                <p class="signup">Not a member? <a href="/register">Sign up now</a></p>
            </form>
        </div>
    </div>
    </main>

    @include('Frontend.components.footer')
</body>

</html>
