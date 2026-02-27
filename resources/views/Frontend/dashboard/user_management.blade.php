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
        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1300px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .dashboard-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 40px;
            min-width: 0;
        }

        .settings-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .settings-card:hover {
            transform: translate(-4px, -4px);
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

        .user-search-input {
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
            white-space: nowrap;
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

        /* MAKE ADMIN MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(74, 44, 42, 0.55);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: var(--bg-primary);
            border: 2px solid var(--text);
            padding: 2.5rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 6px 6px 0px var(--text);
            position: relative;
        }

        .modal-box h2 {
            font-size: 1.4rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .modal-message {
            font-size: 0.95rem;
            opacity: 0.75;
            margin: 1rem 0 2rem;
            line-height: 1.6;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            font-size: 1.4rem;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text);
            font-weight: bold;
            line-height: 1;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
        }

        .modal-confirm-btn,
        .modal-cancel-btn {
            flex: 1;
            padding: 0.85rem;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--text);
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .modal-confirm-btn {
            background: var(--text);
            color: var(--bg-primary);
        }

        .modal-confirm-btn:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
            color: var(--white);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--text);
        }

        .modal-cancel-btn {
            background: var(--bg-primary);
            color: var(--text);
        }

        .modal-cancel-btn:hover {
            background: var(--bg-secondary);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--text);
        }

        /* MOBILE FIXES */
        @media (max-width: 900px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .dashboard-layout {
                flex-direction: column;
            }

            .dashboard-content {
                width: 100%;
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
                padding-left: 10px;
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

    <div class="dashboard-layout">
        @include('Frontend.components.admin_sidebar')
        <div class="dashboard-content">

        <section class="settings-card">
            <h2 class="section-title">User Directory</h2>

            <form class="search-wrapper" action="{{ route('userManagement') }}" method="GET">
                <input type="text" name="query" class="user-search-input" placeholder="Search users..."
                    value="{{ $searchQuery ?? '' }}">
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
                                    <form action="{{ route('users.removeAdmin', $user->userID) }}" method="POST"
                                        id="removeAdminForm-{{ $user->userID }}"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="btn-action btn-danger"
                                            data-user-id="{{ $user->userID }}"
                                            data-user-name="{{ $user->firstName }} {{ $user->lastName }}"
                                            onclick="openRemoveAdminModal(this.dataset.userId, this.dataset.userName)">Remove Admin</button>
                                    </form>
                                @else
                                    <form action="{{ route('users.makeAdmin', $user->userID) }}" method="POST"
                                        id="makeAdminForm-{{ $user->userID }}"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="btn-action btn-make-admin"
                                            data-user-id="{{ $user->userID }}"
                                            data-user-name="{{ $user->firstName }} {{ $user->lastName }}"
                                            onclick="openMakeAdminModal(this.dataset.userId, this.dataset.userName)">Make Admin</button>
                                    </form>

                                    <form action="{{ route('admin.users.destroy', $user->userID) }}" method="POST"
                                        id="deleteUserForm-{{ $user->userID }}"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action btn-danger"
                                            data-user-id="{{ $user->userID }}"
                                            data-user-name="{{ $user->firstName }} {{ $user->lastName }}"
                                            onclick="openDeleteUserModal(this.dataset.userId, this.dataset.userName)">Delete</button>
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

        </div>
    </div>

    {{-- MAKE ADMIN CONFIRMATION MODAL --}}
    <div class="modal-overlay" id="makeAdminModal">
        <div class="modal-box">
            <button class="modal-close" id="makeAdminClose" aria-label="Close">&times;</button>
            <h2>Confirm Promote to Admin</h2>
            <p class="modal-message">Are you sure you want to make <strong id="makeAdminUserName"></strong> an admin? This will grant them full administrative privileges.</p>
            <div class="modal-actions">
                <button type="button" class="modal-confirm-btn" id="makeAdminConfirm">Yes, Make Admin</button>
                <button type="button" class="modal-cancel-btn" id="makeAdminCancel">Cancel</button>
            </div>
        </div>
    </div>

    {{-- REMOVE ADMIN CONFIRMATION MODAL --}}
    <div class="modal-overlay" id="removeAdminModal">
        <div class="modal-box">
            <button class="modal-close" id="removeAdminClose" aria-label="Close">&times;</button>
            <h2>Confirm Remove Admin</h2>
            <p class="modal-message">Are you sure you want to remove admin privileges from <strong id="removeAdminUserName"></strong>? They will lose all administrative access.</p>
            <div class="modal-actions">
                <button type="button" class="modal-confirm-btn" id="removeAdminConfirm">Yes, Remove Admin</button>
                <button type="button" class="modal-cancel-btn" id="removeAdminCancel">Cancel</button>
            </div>
        </div>
    </div>

    {{-- DELETE USER CONFIRMATION MODAL --}}
    <div class="modal-overlay" id="deleteUserModal">
        <div class="modal-box">
            <button class="modal-close" id="deleteUserClose" aria-label="Close">&times;</button>
            <h2>Confirm Delete User</h2>
            <p class="modal-message">Are you sure you want to delete <strong id="deleteUserName"></strong>? This action is permanent and cannot be undone.</p>
            <div class="modal-actions">
                <button type="button" class="modal-confirm-btn" id="deleteUserConfirm">Yes, Delete User</button>
                <button type="button" class="modal-cancel-btn" id="deleteUserCancel">Cancel</button>
            </div>
        </div>
    </div>

    @include('Frontend.components.footer')

    <script>
    (function () {
        var pendingAdminFormId = null;
        var modal      = document.getElementById('makeAdminModal');
        var confirmBtn = document.getElementById('makeAdminConfirm');
        var cancelBtn  = document.getElementById('makeAdminCancel');
        var closeBtn   = document.getElementById('makeAdminClose');

        function openMakeAdminModal(userId, userName) {
            pendingAdminFormId = 'makeAdminForm-' + userId;
            document.getElementById('makeAdminUserName').textContent = userName;
            modal.classList.add('active');
        }

        function closeMakeAdminModal() {
            pendingAdminFormId = null;
            modal.classList.remove('active');
        }

        confirmBtn.addEventListener('click', function () {
            if (pendingAdminFormId) {
                document.getElementById(pendingAdminFormId).submit();
            }
        });

        cancelBtn.addEventListener('click', closeMakeAdminModal);
        closeBtn.addEventListener('click', closeMakeAdminModal);
        modal.addEventListener('click', function (e) {
            if (e.target === this) closeMakeAdminModal();
        });

        // Expose opener for inline onclick
        window.openMakeAdminModal = openMakeAdminModal;
    })();

    (function () {
        var pendingRemoveFormId = null;
        var modal      = document.getElementById('removeAdminModal');
        var confirmBtn = document.getElementById('removeAdminConfirm');
        var cancelBtn  = document.getElementById('removeAdminCancel');
        var closeBtn   = document.getElementById('removeAdminClose');

        function openRemoveAdminModal(userId, userName) {
            pendingRemoveFormId = 'removeAdminForm-' + userId;
            document.getElementById('removeAdminUserName').textContent = userName;
            modal.classList.add('active');
        }

        function closeRemoveAdminModal() {
            pendingRemoveFormId = null;
            modal.classList.remove('active');
        }

        confirmBtn.addEventListener('click', function () {
            if (pendingRemoveFormId) {
                document.getElementById(pendingRemoveFormId).submit();
            }
        });

        cancelBtn.addEventListener('click', closeRemoveAdminModal);
        closeBtn.addEventListener('click', closeRemoveAdminModal);
        modal.addEventListener('click', function (e) {
            if (e.target === this) closeRemoveAdminModal();
        });

        // Expose opener for inline onclick
        window.openRemoveAdminModal = openRemoveAdminModal;
    })();

    (function () {
        var pendingDeleteFormId = null;
        var modal      = document.getElementById('deleteUserModal');
        var confirmBtn = document.getElementById('deleteUserConfirm');
        var cancelBtn  = document.getElementById('deleteUserCancel');
        var closeBtn   = document.getElementById('deleteUserClose');

        function openDeleteUserModal(userId, userName) {
            pendingDeleteFormId = 'deleteUserForm-' + userId;
            document.getElementById('deleteUserName').textContent = userName;
            modal.classList.add('active');
        }

        function closeDeleteUserModal() {
            pendingDeleteFormId = null;
            modal.classList.remove('active');
        }

        confirmBtn.addEventListener('click', function () {
            if (pendingDeleteFormId) {
                document.getElementById(pendingDeleteFormId).submit();
            }
        });

        cancelBtn.addEventListener('click', closeDeleteUserModal);
        closeBtn.addEventListener('click', closeDeleteUserModal);
        modal.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteUserModal();
        });

        // Expose opener for inline onclick
        window.openDeleteUserModal = openDeleteUserModal;
    })();
    </script>
</body>

</html>
