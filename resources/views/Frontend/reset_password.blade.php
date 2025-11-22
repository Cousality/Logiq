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
            height: calc(100vh - 100px);
            background-color: #4A1F1F;
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

     
       p.subtitle {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
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

         .error-message {
            background: #ffe6e6;
            color: #b30000;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: left;
        }

  .status-message {
            background: #e6ffea;
            color: #126b2e;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: left; 
        }
    </style>
    </head>

        <body>
    @include('Frontend.components.navbar')

    <div class="login-wrapper">
        <div class="login-container">
            <div class="logo">
                <img src="/Images/logo.png" alt="LOGIQ Logo">
            </div>

    <h2>Reset password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', $email) }}"
                   required
                   autofocus>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">New password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required>
        </div>

        <button type="submit" class="btn">
            Reset password
        </button>
    </form>

