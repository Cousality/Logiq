<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - LOGIQ Admin</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
    <style>
        .dashboard-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg, var(--bg-primary) 60%, var(--red-pastel-1) 60%);
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
            max-width: 1400px;
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

        .btn-edit {
            background: var(--bg-secondary);
            color: var(--text);
        }

        .btn-edit:hover {
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

        .btn-add {
            background: var(--text);
            color: var(--white);
            padding: 8px 20px;
            font-size: 0.9rem;
            border: 2px solid var(--text);
            text-decoration: none;
            font-weight: bold;
            font-family: inherit;
            cursor: pointer;
            transition: 0.2s;
            display: inline-block;
        }

        .btn-add:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
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
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            border: 2px solid var(--text);
            padding: 0.85rem 1rem;
            text-align: left;
            vertical-align: middle;
        }

        .product-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .product-table tr:hover td {
            background-color: var(--bg-primary);
        }

        .action-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid currentColor;
        }

        .badge-easy   { color: #4a7c59; border-color: #4a7c59; }
        .badge-medium { color: #c17f24; border-color: #c17f24; }
        .badge-hard   { color: #a63232; border-color: #a63232; }

        .badge-active { color: #4a7c59; border-color: #4a7c59; }
        .badge-hidden { color: #888;    border-color: #888; }

        .thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border: 1px solid var(--text);
        }

        .no-thumb {
            width: 48px;
            height: 48px;
            background: var(--bg-secondary);
            border: 1px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
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
            .product-table, .product-table tbody, .product-table tr, .product-table td {
                display: block; width: 100%;
            }
            .product-table thead { display: none; }
            .product-table tr {
                margin-bottom: 15px;
                border: 2px solid var(--text);
            }
            .product-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid var(--text);
            }
            .product-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
            .action-cell { justify-content: flex-end; }
        }
    </style>
</head>
<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">Inventory Management</h1>
        <p>Manage products, stock levels, and visibility.</p>
    </header>

    <main>
        <div class="dashboard-layout">
            @include('Frontend.components.admin_sidebar')
            <div class="dashboard-content">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="settings-card">
            <h2 class="section-title">
                <span>All Products ({{ $products->total() }})</span>
                @if(auth()->user()->admin)
                    <a href="{{ route('admin.products.create') }}" class="btn-add">+ Add Product</a>
                @endif
            </h2>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Difficulty</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Status</th>
                        @if(auth()->user()->admin)
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td data-label="Image">
                                @if($product->productImage)
                                    <img src="{{ $product->imageUrl }}"
                                         alt="{{ $product->productName }}"
                                         class="thumb">
                                @else
                                    <div class="no-thumb">🧩</div>
                                @endif
                            </td>
                            <td data-label="Name"><strong>{{ $product->productName }}</strong></td>
                            <td data-label="Category">{{ $product->productCategory }}</td>
                            <td data-label="Difficulty">
                                <span class="badge badge-{{ strtolower($product->productDifficulty) }}">
                                    {{ strtoupper($product->productDifficulty) }}
                                </span>
                            </td>
                            <td data-label="Price">£{{ number_format($product->productPrice, 2) }}</td>
                            <td data-label="Qty">{{ $product->productQuantity }}</td>
                            <td data-label="Status">
                                <span class="badge badge-{{ $product->productStatus }}">
                                    {{ strtoupper($product->productStatus) }}
                                </span>
                            </td>
                            @if(auth()->user()->admin)
                                <td data-label="Actions">
                                    <div class="action-cell">
                                        <a href="{{ route('admin.products.edit', $product->productID) }}"
                                           class="btn-action btn-edit">Edit</a>

                                        <form action="{{ route('admin.products.destroy', $product->productID) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete {{ addslashes($product->productName) }}? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->admin ? 8 : 7 }}"
                                style="text-align:center; padding:2rem;">
                                No products found. <a href="{{ route('admin.products.create') }}">Add one now.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="pagination-wrapper">
                    {{-- Previous --}}
                    @if($products->onFirstPage())
                        <span class="disabled">&laquo;</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}">&laquo;</a>
                    @endif

                    {{-- Page numbers --}}
                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if($page == $products->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}">&raquo;</a>
                    @else
                        <span class="disabled">&raquo;</span>
                    @endif
                </div>
            @endif
        </section>

            </div>
        </div>
    </main>

    @include('Frontend.components.footer')
</body>
</html>
