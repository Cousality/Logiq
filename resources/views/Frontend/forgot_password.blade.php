<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - LOGIQ</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }



        .forgot-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #4A1F1F;
            padding: 40px 0; 
        }

        .forgot-container {
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
            margin-bottom: 10px;
            color: #333;
        }

        .forgot-container p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .forgot-container input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
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

        a.back {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #4A1F1F;
            text-decoration: none;
            font-weight: 500;
        }
    </style>

</head>

<body>
    @include('Frontend.components.navbar')

    <main>
        <div class="forgot-wrapper">
            <div class="forgot-container">
                <div class="logo">
                    <img src="Images/logo.png" alt="LOGIQ Logo">
                </div>

                <h2>Forgot Password?</h2>
                <p>Enter your email address to receive a password reset link.</p>

                <form method="POST" action="#">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn">Send Reset Link</button>
                </form>

                <a href="/login" class="back">Back to Login</a>
            </div>
        </div>
    </main>
    @include('Frontend.components.footer')

</body>

</html>
