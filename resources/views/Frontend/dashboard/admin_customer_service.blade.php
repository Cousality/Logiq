<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - LOGIQ Admin</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
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

        .back-nav {
            margin-top: 50px;
            margin-bottom: 25px;
            margin-left: 20%;
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

        .stats-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            width: 60%;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            margin: 0 auto;
            transition: 0.3s;
        }

        .stats-container:hover {
            box-shadow: 6px 6px 0px var(--text);
        }

        .stat-card {
            background: var(--bg-secondary);
            border: 2px solid var(--text);
            padding: 10px;
            text-align: center;
            overflow: hidden;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text);
            font-size: 14px;
            text-transform: uppercase;
            
        }

        .tickets-container {
            width: 60%;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            margin: 0 auto;
            margin-top: 20px;
            transition: 0.3s;
        }

        .tickets-container:hover {
            box-shadow: 6px 6px 0px var(--text);
        }

        .tickets-header {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }

        .tickets-list {
            display: flex;
            flex-direction: column;
        }

        .no-tickets {
            text-align: center;
            padding: 30px;
            color: var(--text);
            font-size: 16px;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

             .stats-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>

</head>

<body>

    @include('Frontend.components.nav')

    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">Customer Service</h2>
            <p>Manage and respond to customer support tickets</p>
        </header>

        <div class="back-nav">
            <a href="{{ route('dashboard') }}" class="btn-secondary"> <- Back to Dashboard</a>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{ $tickets->count() }}</div>
                <div class="stat-label">Total Tickets</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $tickets->where('problemCategory', 'Delivery')->count() }}</div>
                <div class="stat-label">Delivery Issues</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $tickets->where('problemCategory', 'Refund')->count() }}</div>
                <div class="stat-label">Refund Requests</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $tickets->where('problemCategory', 'Account')->count() }}</div>
                <div class="stat-label">Account Issues</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $tickets->where('problemCategory', 'Payment')->count() }}</div>
                <div class="stat-label">Payment Issues</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $tickets->where('problemCategory', 'Other')->count() }}</div>
                <div class="stat-label">Other Issues</div>
            </div>
        </div>

        <div class="tickets-container">
            <div class="tickets-header">
                <h3>Support Tickets</h3>
            </div>

            <div class="tickets-list">
                @if ($tickets->isEmpty())
                    <div class="no-tickets">
                        No support tickets found.
                    </div>
                @else
                    @foreach ($tickets as $ticket)
                         @include('Frontend.components.contact_ticket', ['ticket' => $ticket])
                    @endforeach
                @endif
            </div>
        </div>
    </main>

    @include('Frontend.components.footer')

    <script>
        function resolveTicket(ticketId) {
            if (confirm('Are you sure you want to mark this ticket as resolved?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/tickets/' + ticketId + '/resolve';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

</body>

</html>
