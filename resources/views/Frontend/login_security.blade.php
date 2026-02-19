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
        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            font-family: inherit;
            border: 2px solid var(--text);
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--text);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--bg-primary);
            color: var(--text);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--red-pastel-1);
            color: var(--white);
            border-color: var(--red-pastel-1);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
        }

        .btn-secondary:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }

        .back-nav {
            margin-bottom: 10px;
        }

        .btn-danger:hover {
            background: var(--white);
            color: var(--red-pastel-1);
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
            <a href="{{ route('dashboard') }}" class="btn btn-secondary"> <- Back to Dashboard</a>
        </div>
        <section class="settings-card">
            <h2 class="section-title">Profile Information</h2>
            <form action="#" method="POST">
                <div class="grid-2-col">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </section>

        <section class="settings-card">
            <h2 class="section-title">Change Password</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="current_password" name="current_password" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('current_password')">Show</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="new_password" name="new_password" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('new_password')">Show</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('new_password_confirmation')">Show</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </section>

        <section class="settings-card" style="border-color: var(--red-pastel-1);">
            <h2 class="section-title" style="border-bottom-color: var(--red-pastel-1); color: var(--red-pastel-1);">
                Danger Zone</h2>
            <p class="warning-text">WARNING: Deleting your account is permanent. All orders, puzzle progress, and
                settings will be permanently erased.</p>

            <form action="#" method="POST"
                onsubmit="return confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.');">
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </section>

    </main>

    @include('Frontend.components.footer')
    <script src="{{ asset('js/togglePassword.js') }}"></script>
</body>

</html>
