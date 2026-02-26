<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions - LOGIQ Admin</title>
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
            transition: 0.3s;
        }

        .settings-card:hover {
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

        .promo-table {
            width: 100%;
            border-collapse: collapse;
        }

        .promo-table th,
        .promo-table td {
            border: 2px solid var(--text);
            padding: 0.85rem 1rem;
            text-align: left;
            vertical-align: middle;
        }

        .promo-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .promo-table tr:hover td {
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

        .badge-percentage { color: #4a7c59; border-color: #4a7c59; }
        .badge-fixed      { color: #c17f24; border-color: #c17f24; }

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
            .promo-table, .promo-table tbody, .promo-table tr, .promo-table td {
                display: block; width: 100%;
            }
            .promo-table thead { display: none; }
            .promo-table tr {
                margin-bottom: 15px;
                border: 2px solid var(--text);
            }
            .promo-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid var(--text);
            }
            .promo-table td::before {
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
        <h1 class="dashboard-title">Promotions</h1>
        <p>Manage promotion codes and discounts.</p>
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
                        <span>All Promotions ({{ $promotions->total() }})</span>
                        <a href="{{ route('admin.promotions.create') }}" class="btn-add">+ Add Promotion</a>
                    </h2>

                    <table class="promo-table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promotions as $promotion)
                                <tr>
                                    <td data-label="Code"><strong>{{ $promotion->promotionCode }}</strong></td>
                                    <td data-label="Type">
                                        <span class="badge badge-{{ $promotion->discountType }}">
                                            {{ ucfirst($promotion->discountType) }}
                                        </span>
                                    </td>
                                    <td data-label="Value">
                                        @if($promotion->discountType === 'percentage')
                                            {{ number_format($promotion->discountValue, 2) }}%
                                        @else
                                            £{{ number_format($promotion->discountValue, 2) }}
                                        @endif
                                    </td>
                                    <td data-label="Actions">
                                        <div class="action-cell">
                                            <a href="{{ route('admin.promotions.edit', $promotion->promotionID) }}"
                                               class="btn-action btn-edit">Edit</a>

                                            <form action="{{ route('admin.promotions.destroy', $promotion->promotionID) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete promotion {{ addslashes($promotion->promotionCode) }}? This cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center; padding:2rem;">
                                        No promotions found. <a href="{{ route('admin.promotions.create') }}">Add one now.</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($promotions->hasPages())
                        <div class="pagination-wrapper">
                            @if($promotions->onFirstPage())
                                <span class="disabled">&laquo;</span>
                            @else
                                <a href="{{ $promotions->previousPageUrl() }}">&laquo;</a>
                            @endif

                            @foreach($promotions->getUrlRange(1, $promotions->lastPage()) as $page => $url)
                                @if($page == $promotions->currentPage())
                                    <span class="active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($promotions->hasMorePages())
                                <a href="{{ $promotions->nextPageUrl() }}">&raquo;</a>
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
