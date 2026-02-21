<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Security - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />

    <style>
        /* HEADER */
        .dashboard-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .dashboard-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        /* SETTINGS */
        .settings-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 50px 5%;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .settings-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            transition: 0.3s;
        }

        .settings-card:hover {
            box-shadow: 6px 6px 0px var(--text);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }


        .grid-2-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        /* BUTTONS */

        .back-nav {
            margin-bottom: 10px;
        }

        .btn-danger {
            background: var(--red-pastel-1);
            color: var(--white);
            border-color: var(--red-pastel-1);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            padding: 10px 15px;
            text-decoration: none;
            border: 2px solid var(--text);
            display: inline-block;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }


        .btn-danger:hover {
            transform: translateY(-2px);
        }

        .warning-text {
            color: var(--red-pastel-1);
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* MOBILE FIXES */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .grid-2-col {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">Login & Security</h1>
        <p>Manage your account credentials and profile information.</p>
    </header>


    <main class="settings-container">
        <div class="back-nav">
            <a href="{{ route('dashboard') }}" class="btn-secondary"> <- Back to Dashboard</a>
        </div>
        @if (session('success'))
            <div
                style="padding: 1rem; background: #d4edda; color: #155724; border: 2px solid #c3e6cb; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @else
            @if ($errors->any())
                <div
                    style="padding: 1rem; background: #f8d7da; color: #721c24; border: 2px solid #f5c6cb; margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
        <section class="settings-card">
            <h2 class="section-title">Profile Information</h2>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="grid-2-col">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control"
                            value="{{ old('first_name', $user->firstName) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control"
                            value="{{ old('last_name', $user->lastName) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <button type="submit" class="btn">Save Changes</button>
            </form>
        </section>

        <section class="settings-card">
            <h2 class="section-title">Change Password</h2>
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                            required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('current_password')">Show</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="new_password" name="new_password" placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('new_password')">Show</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            placeholder="••••••••" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('new_password_confirmation')">Show</button>
                    </div>
                </div>

                <button type="submit" class="btn">Update Password</button>
            </form>
        </section>

        <section class="settings-card" style="border-color: var(--red-pastel-1);">
            <h2 class="section-title" style="border-bottom-color: var(--red-pastel-1); color: var(--red-pastel-1);">
                Danger Zone</h2>
            <p class="warning-text">WARNING: Deleting your account is permanent. All orders, puzzle progress, and
                settings will be permanently erased.</p>

            <form action="{{ route('profile.destroy') }}" method="POST"
                onsubmit="return confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.');">
                @csrf
                @method('DELETE') <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </section>

    </main>

    @include('Frontend.components.footer')
    <script src="{{ asset('js/togglePassword.js') }}"></script>
</body>

</html>
