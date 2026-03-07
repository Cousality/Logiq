<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Analysis - LOGIQ</title>
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
            overflow-x: auto;
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
        }

        .empty-stats {
            text-align: center;
            padding: 50px 0;
        }

        /* Table */
        .stats-table {
            width: 100%;
            border-collapse: collapse;
        }

        .stats-table th,
        .stats-table td {
            border: 2px solid var(--text);
            padding: 0.85rem 1rem;
            text-align: left;
            vertical-align: middle;
        }

        .stats-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .stats-table tr:hover td {
            background-color: var(--bg-primary);
        }

        /* Buttons */
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

        .btn-details {
            background: var(--bg-secondary);
            color: var(--text);
        }

        .btn-details:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
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

        /* Modal */
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
            max-width: 700px;
            max-height: 80vh;
            overflow-y: auto;
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

        @media (max-width: 768px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; align-items: stretch; }
            .management-container { padding: 1rem; }
            .stats-table, .stats-table tbody, .stats-table tr, .stats-table td {
                display: block; width: 100%;
            }
            .stats-table thead { display: none; }
            .stats-table tr {
                margin-bottom: 15px;
                border: 2px solid var(--text);
            }
            .stats-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid var(--text);
            }
            .stats-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')
    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">Stock Analysis</h1>
            <p>View product sales performance and stock levels.</p>
        </header>

        <div class="dashboard-layout">
            @include('Frontend.components.admin_sidebar')
            <div class="dashboard-content">
                <div class="management-container">
                    <h2 class="section-title">Product Statistics</h2>

                    @if($productStats->count() > 0)
                        <table class="stats-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Current Qty</th>
                                    <th>Status</th>
                                    <th>Qty Sold</th>
                                    <th>Revenue</th>
                                    <th>Total Orders</th>
                                    <th>View Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productStats as $stat)
                                    <tr>
                                        <td data-label="Product"><strong>{{ $stat->productName }}</strong></td>
                                        <td data-label="Current Qty">{{ $stat->productQuantity }}</td>
                                        <td data-label="Status"
                                            @if($stat->productQuantity <= 5)
                                                style="background: #fce4e4; color: #a63232; font-weight: bold;"
                                            @elseif($stat->productQuantity > 30)
                                                style="background: #fff3e0; color: #e65100; font-weight: bold;"
                                            @else
                                                style="background: #e4f5e9; color: #2e7d32; font-weight: bold;"
                                            @endif
                                        >
                                            @if($stat->productQuantity <= 5)
                                                Low Stock
                                            @elseif($stat->productQuantity > 30)
                                                Over Stock
                                            @else
                                                Normal
                                            @endif
                                        </td>
                                        <td data-label="Qty Sold">{{ $stat->total_sold }}</td>
                                        <td data-label="Revenue">£{{ number_format($stat->total_revenue, 2) }}</td>
                                        <td data-label="Total Orders">{{ $stat->order_count }}</td>
                                        <td data-label="View Orders">
                                            @if($stat->order_count > 0)
                                                <button type="button" class="btn-action btn-details"
                                                    onclick="openModal({{ $stat->productID }})">
                                                    View Orders
                                                </button>
                                            @else
                                                <span style="opacity:0.4;">None</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        @if($productStats->hasPages())
                            <div class="pagination-wrapper">
                                @if($productStats->onFirstPage())
                                    <span class="disabled">&laquo;</span>
                                @else
                                    <a href="{{ $productStats->previousPageUrl() }}">&laquo;</a>
                                @endif

                                @foreach($productStats->getUrlRange(1, $productStats->lastPage()) as $page => $url)
                                    @if($page == $productStats->currentPage())
                                        <span class="active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if($productStats->hasMorePages())
                                    <a href="{{ $productStats->nextPageUrl() }}">&raquo;</a>
                                @else
                                    <span class="disabled">&raquo;</span>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="empty-stats">
                            <h3>No products yet</h3>
                            <p>Products will appear here once they are added.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('Frontend.components.footer')

    <!-- Pre-rendered Product Orders Modals -->
    @foreach($productOrders as $productID => $orders)
        <div class="details-modal-overlay" id="ordersModal-{{ $productID }}">
            <div class="details-modal-box">
                <button class="details-modal-close" onclick="closeModal({{ $productID }})">&times;</button>
                <h2>Orders - {{ $productStats->firstWhere('productID', $productID)->productName ?? 'Product' }}</h2>
                <table class="details-items-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->orderID }}</td>
                                <td>{{ $order->firstName ?? 'Deleted' }} {{ $order->lastName ?? 'User' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>£{{ number_format($order->priceAtTime, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->orderDate)->format('d M Y') }}</td>
                                <td><span class="badge badge-{{ $order->orderStatus }}">{{ $order->orderStatus }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <script>
        function openModal(productId) {
            document.getElementById('ordersModal-' + productId).classList.add('active');
        }

        function closeModal(productId) {
            document.getElementById('ordersModal-' + productId).classList.remove('active');
        }
    </script>
</body>

</html>
