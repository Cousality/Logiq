<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            font-size: 3.5rem;
            letter-spacing: -3px;
            margin-bottom: 0.5rem;
        }

        /* LAYOUT */
        .dashboard-layout {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 5%;
        }

        .orders-container {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        /* FILTER */
        .orders-filter {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .filter-button {
            padding: 8px 18px;
            border: 2px solid var(--text);
            background: var(--bg-primary);
            color: var(--text);
            cursor: pointer;
            font-family: inherit;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.2s;
            text-decoration: none;
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
            border-radius: 8px;
        }

        .order-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--bg-secondary);
            margin: -1.5rem -1.5rem 1rem -1.5rem;
            border-bottom: 1px solid var(--text);
        }

        .order-info {
            display: flex;
            gap: 30px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .order-info-item span {
            display: block;
            font-weight: bold;
            margin-top: 3px;
        }

        .order-status {
            padding: 5px 14px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            border: 2px solid var(--text);
            border-radius: 999px;
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
            min-width: 220px;
        }

        .item-image {
            width: 70px;
            height: 70px;
            border: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
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

        /* ACTIONS */
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
            font-size: 12px;
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
            .order-header { flex-direction: column; align-items: flex-start; gap: 10px; }
            .order-info { flex-direction: column; gap: 8px; }
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
        <main class="orders-container">

            <div class="orders-filter">
                <a class="filter-button {{ !request('status') || request('status') == 'all' ? 'active' : '' }}"
                    href="{{ route('dashboard.orders') }}">All</a>
                <a class="filter-button {{ request('status') == 'processing' ? 'active' : '' }}"
                    href="{{ route('dashboard.orders', ['status' => 'processing']) }}">Processing</a>
                <a class="filter-button {{ request('status') == 'shipped' ? 'active' : '' }}"
                    href="{{ route('dashboard.orders', ['status' => 'shipped']) }}">Shipped</a>
                <a class="filter-button {{ request('status') == 'delivered' ? 'active' : '' }}"
                    href="{{ route('dashboard.orders', ['status' => 'delivered']) }}">Delivered</a>
                <a class="filter-button {{ request('status') == 'cancelled' ? 'active' : '' }}"
                    href="{{ route('dashboard.orders', ['status' => 'cancelled']) }}">Cancelled</a>
                <a class="filter-button {{ request('status') == 'exchanges' ? 'active' : '' }}"
                    href="{{ route('dashboard.orders', ['status' => 'exchanges']) }}">Exchanges</a>
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
                                    <div class="item-meta">Qty: {{ $item->quantity }} · £{{ number_format($item->priceAtTime * $item->quantity, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-actions">
                        @if ($order->orderStatus != 'cancelled' && $order->orderStatus != 'delivered')
                            <button class="action-button primary">Track Order</button>
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
                    <h3>No orders found.</h3>
                    <p style="opacity: 0.7;">There are no orders in this category yet.</p>
                </div>
            @endforelse

        </main>
    </div>

    @include('Frontend.components.footer')
</body>
</html>