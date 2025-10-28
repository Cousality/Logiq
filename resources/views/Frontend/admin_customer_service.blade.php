<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - LOGIQ Admin</title>

    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        .page-header h2 {
            font-family: 'Inria Serif';
            font-size: 40px;
            color: rgba(49, 14, 14, 1);
            margin: 0 0 10px 0;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .dashboard-content {
            flex: 1;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: rgba(49, 14, 14, 1);
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .tickets-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px px rgba(0, 0, 0, 0.1);
        }

        .tickets-header {
            margin-bottom: 25px;
        }

        .tickets-header h3 {
            font-family: 'Inria Serif';
            font-size: 25px;
            color: rgba(49, 14, 14, 1);
            margin: 0;
        }

        .tickets-list {
            display: flex;
            flex-direction: column;
        }

        .no-tickets {
            text-align: center;
            padding: 30px;
            color: #666;
            font-size: 16px;
        }
    </style>

</head>

<body>

    @include('Frontend.components.navbar')

    <main>
        <div class="dashboard-layout">

            @include('Frontend.components.dashboard_sidebar')

            <div class="dashboard-content">

                <div class="page-header">
                    <h2>Customer Service Admin Dashboard</h2>
                    <p class="page-subtitle">Manage and respond to customer support tickets</p>
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
