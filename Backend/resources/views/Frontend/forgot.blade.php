<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - LOGIQ</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #4A1F1F; /* LOGIQ dark maroon */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forgot-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
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

        .subtitle {
            font-size: 13px;
            color: #888;
            margin-bottom: 25px;
            line-height: 1.5;
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

        .back-to-login {
            margin-top: 15px;
            font-size: 14px;
        }

        .back-to-login a {
            color: #4A1F1F;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="forgot-container">
        <div class="logo">
            <img src="Images\logo.png" alt="LOGIQ Logo">
        </div>
        <h2>Forgot Password?</h2>
        <p class="subtitle">Enter your email address and we'll send you instructions to reset your password.</p>

        <form method="POST" action="">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <button type="submit" class="btn">Send Reset Link</button>
            <p class="back-to-login">Remember your password? <a href="login">Sign in now</a></p>
        </form>
    </div>

</body>
</html>