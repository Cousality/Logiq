<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - LOGIQ</title>
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
            max-width: 1800px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .dashboard-content {
            flex: 1;
            min-width: 0;
        }

        .management-container {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            box-shadow: 0px 0px 0px var(--red-pastel-1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .management-container:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0px var(--red-pastel-1);
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

        .flash-success {
            background: #d4edda;
            border: 2px solid var(--text);
            color: #155724;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .flash-error {
            background: #f8d7da;
            border: 2px solid var(--text);
            color: #721c24;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .empty-orders {
            text-align: center;
            padding: 50px 0;
        }

        /* Summary bar */
        .summary-bar {
            display: flex;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        .summary-stat strong {
            display: block;
            font-size: 1.8rem;
            font-weight: 900;
            letter-spacing: -1px;
            line-height: 1;
        }

        .summary-stat span {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.6;
        }

        /* Filter */
        .filter-bar {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .filter-bar select {
            padding: 0.5rem 1rem;
            border: 2px solid var(--text);
            background: var(--bg-primary);
            color: var(--text);
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            appearance: auto;
        }

        .filter-bar select:hover {
            background: var(--text);
            color: var(--bg-primary);
        }

        .btn-filter {
            padding: 0.5rem 1rem;
            background: var(--text);
            color: var(--bg-primary);
            border: 2px solid var(--text);
            font-family: inherit;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.8rem;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .btn-filter:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
            color: var(--bg-primary);
        }

        /* Table */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th,
        .orders-table td {
            border: 2px solid var(--text);
            padding: 0.85rem 1rem;
            text-align: left;
            vertical-align: middle;
        }

        .orders-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .orders-table tr:hover td {
            background-color: var(--bg-primary);
        }

        /* Status badges */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid currentColor;
        }

        .badge-pending    { color: #c17f24; border-color: #c17f24; background: #fff8e1; }
        .badge-processing { color: #2563eb; border-color: #2563eb; background: #eff6ff; }
        .badge-shipped    { color: #7c3aed; border-color: #7c3aed; background: #f5f3ff; }
        .badge-delivered  { color: #4a7c59; border-color: #4a7c59; background: #f0fdf4; }
        .badge-cancelled  { color: #a63232; border-color: #a63232; background: #fef2f2; }

        /* Status update form */
        .status-form {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .status-form select {
            padding: 0.5rem 1rem;
            border: 2px solid var(--text);
            background: var(--bg-primary);
            color: var(--text);
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            appearance: auto;
        }

        .status-form select:hover {
            background: var(--text);
            color: var(--bg-primary);
        }

        .btn-action {
            padding: 5px 14px;
            font-weight: bold;
            cursor: pointer;
            border: 2px solid var(--text);
            transition: 0.2s;
            font-family: inherit;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update {
            background: var(--text);
            color: var(--white);
        }

        .btn-update:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
            transform: translateY(-2px);
        }

        /* Details button */
        .btn-details {
            background: var(--bg-secondary);
            color: var(--text);
        }

        .btn-details:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Details modal */
        .details-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(74, 44, 42, 0.55);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .details-modal-overlay.active { display: flex; }
        .details-modal-box {
            background: var(--bg-primary);
            border: 2px solid var(--text);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 6px 6px 0px var(--text);
            position: relative;
        }
        .details-modal-box h2 {
            font-size: 1.3rem;
            text-transform: uppercase;
            margin-bottom: 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--text);
        }
        .details-modal-close {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            font-size: 1.4rem;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text);
            font-weight: bold;
        }
        .details-items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        .details-items-table th,
        .details-items-table td {
            border: 2px solid var(--text);
            padding: 0.6rem 0.8rem;
            text-align: left;
            font-size: 0.85rem;
        }
        .details-items-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
            font-size: 0.75rem;
        }
        .details-total {
            text-align: right;
            font-weight: 900;
            font-size: 1.1rem;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            padding: 6px 14px;
            border: 2px solid var(--text);
            font-weight: bold;
            font-size: 0.9rem;
            text-decoration: none;
            color: var(--text);
        }

        .pagination-wrapper a:hover {
            background: var(--text);
            color: var(--white);
        }

        .pagination-wrapper span.active {
            background: var(--text);
            color: var(--white);
        }

        .pagination-wrapper span.disabled {
            opacity: 0.4;
        }

        @media (max-width: 900px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; }
            .management-container { padding: 1rem; }
            .orders-table, .orders-table tbody, .orders-table tr, .orders-table td {
                display: block; width: 100%;
            }
            .orders-table thead { display: none; }
            .orders-table tr {
                margin-bottom: 15px;
                border: 2px solid var(--text);
            }
            .orders-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid var(--text);
            }
            .orders-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
            .summary-bar { flex-wrap: wrap; gap: 1rem; }
            .status-form { flex-wrap: wrap; justify-content: flex-end; }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')
    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">Order Management</h1>
            <p>View and manage all customer orders.</p>
        </header>

        <div class="dashboard-layout">
            @include('Frontend.components.admin_sidebar')
            <div class="dashboard-content">
                <div class="management-container">
                    <h2 class="section-title">All Orders</h2>

                    @if(session('success'))
                        <div class="flash-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="flash-error">{{ session('error') }}</div>
                    @endif

                    @if($orders->isEmpty() && !request('status'))
                        <div class="empty-orders">
                            <h3>No orders yet</h3>
                            <p>Orders will appear here once customers place them.</p>
                        </div>
                    @else
                        <div class="summary-bar">
                            <div class="summary-stat">
                                <strong>{{ $totalOrders }}</strong>
                                <span>Total Orders</span>
                            </div>
                            <div class="summary-stat">
                                <strong>£{{ number_format($totalRevenue, 2) }}</strong>
                                <span>Revenue</span>
                            </div>
                            <div class="summary-stat">
                                <strong>{{ $pendingCount }}</strong>
                                <span>Pending</span>
                            </div>
                        </div>

                        {{-- Status filter --}}
                        <form method="GET" action="{{ route('admin.orders.index') }}" class="filter-bar">
                            <select name="status">
                                <option value="all">All Statuses</option>
                                <option value="pending"    {{ request('status') === 'pending'    ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped"    {{ request('status') === 'shipped'    ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered"  {{ request('status') === 'delivered'  ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled"  {{ request('status') === 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn-filter">Filter</button>
                        </form>

                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Update Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td data-label="Order #"><strong>#{{ $order->orderID }}</strong></td>
                                        <td data-label="Customer">
                                            @if($order->user)
                                                {{ $order->user->firstName }} {{ $order->user->lastName }}
                                            @else
                                                <span style="opacity:0.4;">Deleted user</span>
                                            @endif
                                        </td>
                                        <td data-label="Items">
                                            <button type="button" class="btn-action btn-details"
                                                onclick="openDetailsModal({{ $order->orderID }})">
                                                Details ({{ $order->orderItems->count() }})
                                            </button>
                                        </td>
                                        <td data-label="Total">£{{ number_format($order->totalAmount, 2) }}</td>
                                        <td data-label="Status">
                                            <span class="badge badge-{{ $order->orderStatus }}">
                                                {{ ucfirst($order->orderStatus) }}
                                            </span>
                                        </td>
                                        <td data-label="Date">{{ $order->orderDate->format('d M Y') }}</td>
                                        <td data-label="Update Status">
                                            <form method="POST"
                                                  action="{{ route('admin.orders.updateStatus', $order->orderID) }}"
                                                  class="status-form">
                                                @csrf
                                                @method('PATCH')
                                                <select name="orderStatus">
                                                    <option value="pending"    {{ $order->orderStatus === 'pending'    ? 'selected' : '' }}>Pending</option>
                                                    <option value="processing" {{ $order->orderStatus === 'processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="shipped"    {{ $order->orderStatus === 'shipped'    ? 'selected' : '' }}>Shipped</option>
                                                    <option value="delivered"  {{ $order->orderStatus === 'delivered'  ? 'selected' : '' }}>Delivered</option>
                                                    <option value="cancelled"  {{ $order->orderStatus === 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                                <button type="submit" class="btn-action btn-update">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align:center; padding:2rem;">
                                            No orders match this filter.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        @if($orders->hasPages())
                            <div class="pagination-wrapper">
                                @if($orders->onFirstPage())
                                    <span class="disabled">&laquo;</span>
                                @else
                                    <a href="{{ $orders->previousPageUrl() }}">&laquo;</a>
                                @endif

                                @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                    @if($page == $orders->currentPage())
                                        <span class="active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if($orders->hasMorePages())
                                    <a href="{{ $orders->nextPageUrl() }}">&raquo;</a>
                                @else
                                    <span class="disabled">&raquo;</span>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </main>
    @include('Frontend.components.footer')

    {{-- Order Details Modal --}}
    <div class="details-modal-overlay" id="detailsModal">
        <div class="details-modal-box">
            <button class="details-modal-close" onclick="closeDetailsModal()">&times;</button>
            <h2 id="detailsModalTitle">Order Details</h2>
            <table class="details-items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="detailsModalBody"></tbody>
            </table>
            <div class="details-total" id="detailsModalTotal"></div>
        </div>
    </div>

    <script>
        var orderData = {};
        @foreach($orders as $order)
            orderData[{{ $order->orderID }}] = {
                items: [
                    @foreach($order->orderItems as $item)
                    {
                        name: @json($item->product ? $item->product->productName : 'Deleted product'),
                        qty: {{ $item->quantity }},
                        price: {{ $item->priceAtTime }}
                    },
                    @endforeach
                ],
                total: {{ $order->totalAmount }}
            };
        @endforeach

        function openDetailsModal(orderId) {
            var data = orderData[orderId];
            if (!data) return;
            document.getElementById('detailsModalTitle').textContent = 'Order #' + orderId;
            var html = '';
            data.items.forEach(function(item) {
                html += '<tr>'
                    + '<td>' + item.name + '</td>'
                    + '<td>' + item.qty + '</td>'
                    + '<td>\u00a3' + item.price.toFixed(2) + '</td>'
                    + '<td>\u00a3' + (item.qty * item.price).toFixed(2) + '</td>'
                    + '</tr>';
            });
            document.getElementById('detailsModalBody').innerHTML = html;
            document.getElementById('detailsModalTotal').textContent = 'Total: \u00a3' + data.total.toFixed(2);
            document.getElementById('detailsModal').classList.add('active');
        }

        function closeDetailsModal() {
            document.getElementById('detailsModal').classList.remove('active');
        }

        document.getElementById('detailsModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetailsModal();
        });
    </script>
</body>
</html>
