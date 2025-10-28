<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - LOGIQ</title>
    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
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

        .page-title {
            font-family: 'Inria Serif';
            font-size: 40px;
            color: #310E0E;
            margin: 0 0 10px 0;
        }

        .page-subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .orders-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .orders-filter {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .filter-button {
            padding: 10px 20px;
            border: 1px solid #ddd;
            background: white;
            color: #666;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .filter-button:hover {
            border-color: #310E0E;
            color: #310E0E;
        }

        .filter-button.active {
            background: #310E0E;
            color: white;
            border-color: #310E0E;
        }

        .order-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.2s;
        }

        .order-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 15px;
        }

        .order-info {
            display: flex;
            gap: 30px;
            font-size: 13px;
            color: #666;
        }

        .order-info-item span {
            display: block;
            color: #333;
            font-weight: 500;
            margin-top: 3px;
        }

        .order-status {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .order-status.pending {
            background: #f8d7da;
            color: #721c24;
        }

        .order-status.delivered {
            background: #d4edda;
            color: #155724;
        }

        .order-status.processing {
            background: #fff3cd;
            color: #856404;
        }

        .order-status.shipped {
            background: #d1ecf1;
            color: #0c5460;
        }

        .order-status.cancelled {
            background: #e2e3e5;
            color: #383d41;
        }

        .order-items {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            gap: 15px;
            flex: 1;
        }

        .item-image {
            width: 80px;
            height: 80px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 11px;
            text-align: center;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            color: #310E0E;
            margin-bottom: 5px;
        }

        .item-meta {
            font-size: 13px;
            color: #666;
        }

        .order-actions {
            display: flex;
            gap: 10px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .action-button {
            padding: 10px 20px;
            border: 1px solid #310E0E;
            background: white;
            color: #310E0E;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .action-button:hover {
            background: #310E0E;
            color: white;
        }

        .action-button.primary {
            background: #310E0E;
            color: white;
        }

        .action-button.primary:hover {
            background: #4A1F1F;
        }



        @media (max-width: 768px) {
            .dashboard-layout {
                flex-direction: column;
            }

            .order-info {
                flex-direction: column;
                gap: 10px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .orders-filter {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <div class="dashboard-layout">
        @include('Frontend.components.dashboard_sidebar')

        <main class="dashboard-content">
            <div class="page-header">
                <h1 class="page-title">My Orders</h1>
                <p class="page-subtitle">View and manage your orders</p>
            </div>

            <div class="orders-container">
                <div class="orders-filter">
                    <button class="filter-button {{ !request('status') || request('status') == 'all' ? 'active' : '' }}" 
                            onclick="window.location.href='{{ route('dashboard.orders') }}'">All Orders</button>
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
                    ORDER PLACED
                    <span>{{ $order->orderDate->format('d M Y') }}</span>
                </div>
                <div class="order-info-item">
                    TOTAL
                    <span>£{{ number_format($order->totalAmount, 2) }}</span>
                </div>
                <div class="order-info-item">
                    ORDER ID
                    <span>#{{ str_pad($order->orderID, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <span class="order-status {{ $order->orderStatus }}">
                {{ ucfirst($order->orderStatus) }}
            </span>
        </div>

        <div class="order-items">
            @foreach($order->orderItems as $item)
                <div class="order-item">
                    <div class="item-image">
                        @if($item->product && $item->product->productImage)
                            <img src="{{ asset($item->product->productImage) }}"
                                 alt="{{ $item->product->productName }}"
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                        @else
                            Product Image
                        @endif
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $item->product->productName }}</div>
                        <div class="item-meta">Quantity: {{ $item->quantity }} | £{{ number_format($item->priceAtTime, 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="order-actions">
            @if($order->orderStatus != 'cancelled' && $order->orderStatus != 'delivered')
                <button class="action-button primary">Track Order</button>
            @endif

            <button class="action-button">View Details</button>

            @if($order->orderStatus == 'delivered')
                <button class="action-button">Request Exchange</button>
            @endif

            @if($order->orderStatus == 'pending' || $order->orderStatus == 'processing')
                <button class="action-button">Cancel Order</button>
            @endif
        </div>
    </div>

@empty
    {{-- EMPTY STATE MESSAGE --}}
    <div class="empty-orders" style="text-align:center; padding: 50px 0; color:#777;">
        <h3>No orders found :(</h3>
        <p>There are no orders in this category yet.</p>
        <p> What are you doing here? Go order!</p>
    </div>
@endforelse
    @include('Frontend.components.footer')
</body>

</html>
