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
            gap: 20px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            width: 100%;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stats-container:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .stat-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 10px;
            text-align: center;
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
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
            opacity: 0.7;
            text-transform: uppercase;
            
        }

        .tickets-container {
            width: 100%;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .tickets-container:hover {
            transform: translate(-4px, -4px);
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

            .dashboard-layout {
                flex-direction: column;
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

        <div class="dashboard-layout">
            @include('Frontend.components.admin_sidebar')
            <div class="dashboard-content">

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
