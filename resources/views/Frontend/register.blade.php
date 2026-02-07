<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

</head>

<body>
    @include('Frontend.components.nav')

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
            <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
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
        <p class="signup">Do have an account? <a href="{{ route('login') }}">login</a></p>

    </form>
    </div>
    </div>
</body>

</html>
