<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - LOGIQ Admin</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

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

        /* CONTAINER & CARDS */
        .management-container {
            max-width: 1200px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* SEARCH BAR */
        .search-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .search-input {
            flex-grow: 1;
            padding: 10px;
            border: 2px solid var(--text);
            font-family: inherit;
            font-size: 1rem;
        }

        .btn-search {
            background: var(--text);
            color: var(--white);
            border: 2px solid var(--text);
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .btn-search:hover {
            transform: translateY(-2px);
        }

        /* USER TABLE */
        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th,
        .user-table td {
            border: 2px solid var(--text);
            padding: 1rem;
            text-align: left;
        }

        .user-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
        }

        .user-table tr:hover {
            background-color: var(--bg-primary);
        }

        /* ACTIONS */
        .action-cell {
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-action {
            padding: 5px 15px;
            font-weight: bold;
            cursor: pointer;
            border: 2px solid var(--text);
            transition: 0.2s;
            font-family: inherit;
        }

        .btn-make-admin {
            background: var(--bg-secondary);
            color: var(--text);
        }

        .btn-make-admin:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--red-pastel-1);
            color: var(--white);
            border-color: var(--red-pastel-1);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
        }

        .back-nav {
            margin-bottom: 10px;
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

        /* MOBILE FIXES */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .search-wrapper {
                flex-direction: column;
            }

            .user-table,
            .user-table tbody,
            .user-table tr,
            .user-table td {
                display: block;
                width: 100%;
            }

            .user-table thead {
                display: none;
            }

            .user-table tr {
                margin-bottom: 15px;
                border: 2px solid var(--text);
            }

            .user-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid var(--text);
            }

            .user-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }

            .action-cell {
                justify-content: flex-end;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">User Management</h1>
        <p>Admin control panel for managing customer accounts and privileges.</p>
    </header>

    <main class="management-container">
        <div class="back-nav">
            <a href="{{ route('dashboard') }}" class="btn-secondary"> <- Back to Dashboard</a>
        </div>

        <section class="settings-card">
            <h2 class="section-title">User Directory</h2>

            <form class="search-wrapper" action="#" method="GET">
                <input type="email" name="search_email" class="search-input" placeholder="Search by email address..."
                    required>
                <button type="submit" class="btn-search">Search</button>
            </form>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td data-label="ID">#{{ $user->userID }}</td>
                            <td data-label="Name">{{ $user->firstName }} {{ $user->lastName }}</td>
                            <td data-label="Email">{{ $user->email }}</td>
                            <td data-label="Role">{{ $user->admin ? 'Admin' : 'User' }}</td>
                            <td data-label="Actions" class="action-cell">
                                @if ($user->admin)
                                    <span style="opacity: 0.5; padding: 5px 10px;">Already Admin</span>
                                @else
                                    <form action="{{ route('users.makeAdmin', $user->userID) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action btn-make-admin">Make Admin</button>
                                    </form>

                                    <form action="{{ route('admin.users.destroy', $user->userID) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-danger">Delete</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem;">No users found in the
                                database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

    </main>

    @include('Frontend.components.footer')
</body>

</html>
