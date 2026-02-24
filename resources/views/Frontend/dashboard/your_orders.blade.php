<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - LOGIQ</title>
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

        /* LAYOUT */
        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .orders-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* FILTER */
        .orders-filter {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-button {
            padding: 8px 16px;
            border: 2px solid var(--text);
            background: var(--bg-primary);
            color: var(--text);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .filter-button:hover,
        .filter-button.active {
            background: var(--text);
            color: var(--text-light);
        }

        /* ORDER CARD */
        .order-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 1.5rem;
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .order-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--text);
            margin-bottom: 1rem;
        }

        .order-info {
            display: flex;
            gap: 30px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .order-info-item span {
            display: block;
            font-weight: bold;
            margin-top: 3px;
        }

        .order-status {
            padding: 4px 12px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            border: 2px solid var(--text);
        }

        .order-status.pending    { background: #fff3cd; }
        .order-status.delivered  { background: #d4edda; }
        .order-status.processing { background: #fce5ad; }
        .order-status.shipped    { background: #d1ecf1; }
        .order-status.cancelled  { background: #e2e3e5; }

        /* ORDER ITEMS */
        .order-items {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 1rem;
        }

        .order-item {
            display: flex;
            gap: 12px;
            flex: 1;
            min-width: 200px;
        }

        .item-image {
            width: 70px;
            height: 70px;
            border: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            text-align: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .item-meta {
            font-size: 13px;
            opacity: 0.7;
        }

        /* ORDER ACTIONS */
        .order-actions {
            display: flex;
            gap: 10px;
            padding-top: 1rem;
            border-top: 1px solid var(--text);
            flex-wrap: wrap;
        }

        .action-button {
            padding: 8px 16px;
            border: 2px solid var(--text);
            background: var(--bg-primary);
            color: var(--text);
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .action-button:hover {
            background: var(--text);
            color: var(--text-light);
        }

        .action-button.primary {
            background: var(--text);
            color: var(--text-light);
        }

        .action-button.primary:hover {
            background: var(--red-pastel-2);
            color: var(--text-light);
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; padding: 20px 5%; }
            .order-header { flex-direction: column; align-items: flex-start; gap: 10px; }
            .order-info { flex-direction: column; gap: 8px; }
        }

        /* TRACK ORDER MODAL */
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
            max-width: 560px;
            box-shadow: 6px 6px 0px var(--text);
            position: relative;
        }

        .modal-box h2 {
            font-size: 1.4rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .modal-order-meta {
            font-size: 0.85rem;
            opacity: 0.7;
            margin-bottom: 2rem;
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

        /* PROGRESS BAR */
        #progressbar {
            display: flex;
            padding: 0;
            margin: 30px 0 10px;
        }

        #progressbar li {
            list-style: none;
            flex: 1;
            position: relative;
            text-align: center;
        }

        #progressbar li:before {
            width: 40px;
            height: 40px;
            line-height: 40px;
            display: block;
            font-size: 16px;
            background: var(--bg-secondary);
            border-radius: 50%;
            margin: auto;
            color: var(--text);
            content: "";
            position: relative;
            z-index: 1;
        }

        #progressbar li:not(:last-child):after {
            content: '';
            position: absolute;
            top: 14px;
            left: 50%;
            width: 100%;
            height: 12px;
            background: var(--bg-secondary);
            z-index: 0;
        }

        #progressbar li.active:before {
            content: "✓";
            background: var(--text);
            color: var(--text-light);
        }

        #progressbar li.active:has(+ li.active):after {
            background: var(--text);
        }

        .progress-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
        }

        .progress-labels span {
            width: 20%;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            opacity: 0.3;
            transition: opacity 0.2s ease;
        }

        .progress-labels span.active {
            opacity: 1;
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">My Orders</h1>
        <p>View and manage your orders.</p>
    </header>

    <div class="dashboard-layout">
        @include('Frontend.components.dashboard_sidebar')

        <main class="orders-container">

            <div class="orders-filter">
                <button class="filter-button {{ !request('status') || request('status') == 'all' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('dashboard.orders') }}'">All</button>
                <button class="filter-button {{ request('status') == 'processing' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('dashboard.orders', ['status' => 'processing']) }}'">Processing</button>
                <button class="filter-button {{ request('status') == 'shipped' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('dashboard.orders', ['status' => 'shipped']) }}'">Shipped</button>
                <button class="filter-button {{ request('status') == 'delivered' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('dashboard.orders', ['status' => 'delivered']) }}'">Delivered</button>
                <button class="filter-button {{ request('status') == 'cancelled' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('dashboard.orders', ['status' => 'cancelled']) }}'">Cancelled</button>
                <button class="filter-button {{ request('status') == 'exchanges' ? 'active' : '' }}"
                    onclick="window.location.href='{{ route('dashboard.orders', ['status' => 'exchanges']) }}'">Exchanges</button>
            </div>

            @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-info-item">
                                Order Placed
                                <span>{{ $order->orderDate->format('d M Y') }}</span>
                            </div>
                            <div class="order-info-item">
                                Total
                                <span>£{{ number_format($order->totalAmount, 2) }}</span>
                            </div>
                            <div class="order-info-item">
                                Order ID
                                <span>#{{ str_pad($order->orderID, 6, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                        <span class="order-status {{ $order->orderStatus }}">
                            {{ ucfirst($order->orderStatus) }}
                        </span>
                    </div>

                    <div class="order-items">
                        @foreach ($order->orderItems as $item)
                            <div class="order-item">
                                <div class="item-image">
                                    @if ($item->product && $item->product->productImage)
                                        <img src="{{ asset($item->product->productImage) }}"
                                            alt="{{ $item->product->productName }}">
                                    @else
                                        No Image
                                    @endif
                                </div>
                                <div class="item-details">
                                    <div class="item-name">{{ $item->product->productName }}</div>
                                    <div class="item-meta">Qty: {{ $item->quantity }} &middot; £{{ number_format($item->priceAtTime * $item->quantity, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-actions">
                        @if ($order->orderStatus != 'cancelled' && $order->orderStatus != 'delivered')
                            <button class="action-button primary"
                                onclick="openTrackModal('{{ $order->orderID }}', '{{ $order->orderStatus }}', '{{ $order->orderDate->format('d M Y') }}')">Track Order</button>
                        @endif
                        <button class="action-button">View Details</button>
                        @if ($order->orderStatus == 'delivered')
                            <button class="action-button">Request Exchange</button>
                        @endif
                        @if ($order->orderStatus == 'pending' || $order->orderStatus == 'processing')
                            <button class="action-button">Cancel Order</button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="order-card" style="text-align: center; padding: 3rem;">
                    <h3 style="margin-bottom: 0.5rem;">No orders found.</h3>
                    <p style="opacity: 0.7;">There are no orders in this category yet.</p>
                </div>
            @endforelse

        </main>
    </div>

    @include('Frontend.components.footer')

    {{-- TRACK ORDER MODAL --}}
    <div class="modal-overlay" id="trackModal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeTrackModal()">&times;</button>
            <h2>Order <span id="trackOrderId"></span></h2>
            <p class="modal-order-meta">Placed on <span id="trackOrderDate"></span></p>

            <ul id="progressbar">
                <li class="step0" id="step-cart"></li>
                <li class="step0" id="step-pending"></li>
                <li class="step0" id="step-processing"></li>
                <li class="step0" id="step-shipped"></li>
                <li class="step0" id="step-delivered"></li>
            </ul>
            <div class="progress-labels">
                <span>Cart</span>
                <span>Pending</span>
                <span>Processing</span>
                <span>Shipped</span>
                <span>Delivered</span>
            </div>
        </div>
    </div>

    <script>
        const statusSteps = { pending: 1, processing: 2, shipped: 3, delivered: 4 };
        const stepIds = ['step-cart', 'step-pending', 'step-processing', 'step-shipped', 'step-delivered'];
        const labelSpans = document.querySelectorAll('.progress-labels span');

        function openTrackModal(orderId, status, date) {
            document.getElementById('trackOrderId').textContent = '#' + String(orderId).padStart(6, '0');
            document.getElementById('trackOrderDate').textContent = date;

            const activeSteps = (statusSteps[status] ?? 0) + 1;
            stepIds.forEach((id, i) => {
                document.getElementById(id).classList.toggle('active', i < activeSteps);
            });
            labelSpans.forEach((span, i) => {
                span.classList.toggle('active', i < activeSteps);
            });

            document.getElementById('trackModal').classList.add('active');
        }

        function closeTrackModal() {
            document.getElementById('trackModal').classList.remove('active');
        }

        document.getElementById('trackModal').addEventListener('click', function(e) {
            if (e.target === this) closeTrackModal();
        });
    </script>
</body>

</html>
