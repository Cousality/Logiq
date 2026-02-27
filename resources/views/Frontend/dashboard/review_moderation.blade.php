<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Moderation - LOGIQ</title>
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
            min-width: 0;
        }

        .moderation-container {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            box-shadow: 0px 0px 0px var(--red-pastel-1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .moderation-container:hover {
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

        .flash-success {
            background: #d4edda;
            border: 2px solid var(--text);
            color: #155724;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .empty-reviews {
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

        /* Table */
        .reviews-table {
            width: 100%;
            border-collapse: collapse;
        }

        .reviews-table th,
        .reviews-table td {
            border: 2px solid var(--text);
            padding: 0.85rem 1rem;
            text-align: left;
            vertical-align: middle;
        }

        .reviews-table th {
            background: var(--bg-secondary);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .reviews-table tr:hover td {
            background-color: var(--bg-primary);
        }

        .product-name {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.82rem;
        }

        /* Difficulty badge */
        .diff-badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: bold;
            text-transform: uppercase;
            padding: 3px 10px;
            border: 1px solid currentColor;
            white-space: nowrap;
        }

        .diff-badge.easy   { color: #4a7c59; border-color: #4a7c59; }
        .diff-badge.medium { color: #c17f24; border-color: #c17f24; }
        .diff-badge.hard   { color: #a63232; border-color: #a63232; }

        /* Stars */
        .stars-wrap {
            position: relative;
            display: inline-block;
            font-size: 1rem;
            line-height: 1;
            white-space: nowrap;
        }
        .stars-wrap .stars-bg {
            color: #ccc;
            letter-spacing: 2px;
        }
        .stars-wrap .stars-fg {
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            white-space: nowrap;
            color: #c8871a;
            letter-spacing: 2px;
        }

        /* Comment */
        .review-comment {
            opacity: 0.8;
            font-size: 0.85rem;
        }

        .no-comment {
            opacity: 0.35;
            font-style: italic;
        }

        /* Delete button */
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

        .btn-danger {
            background: var(--red-pastel-1);
            color: var(--white);
            border-color: var(--red-pastel-1);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
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
            .moderation-container { padding: 1rem; }
            .reviews-table, .reviews-table tbody, .reviews-table tr, .reviews-table td {
                display: block; width: 100%;
            }
            .reviews-table thead { display: none; }
            .reviews-table tr {
                margin-bottom: 15px;
                border: 2px solid var(--text);
            }
            .reviews-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid var(--text);
            }
            .reviews-table td::before {
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
            .reviews-table td form { display: flex; justify-content: flex-end; }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')
    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">Review Moderation</h1>
            <p>View and delete inappropriate reviews across all products.</p>
        </header>

        <div class="dashboard-layout">
            @include('Frontend.components.admin_sidebar')
            <div class="dashboard-content">
                <div class="moderation-container">
                    <h2 class="section-title">All Reviews</h2>

                    @if(session('success'))
                        <div class="flash-success">{{ session('success') }}</div>
                    @endif

                    @if($reviews->isEmpty())
                        <div class="empty-reviews">
                            <h3>No reviews found</h3>
                            <p>There are no reviews yet.</p>
                        </div>
                    @else
                        <div class="summary-bar">
                            <div class="summary-stat">
                                <strong>{{ $totalCount }}</strong>
                                <span>Total Reviews</span>
                            </div>
                            <div class="summary-stat">
                                <strong>{{ number_format($avgRating, 1) }}</strong>
                                <span>Avg Rating</span>
                            </div>
                            <div class="summary-stat">
                                <strong>{{ $productsReviewed }}</strong>
                                <span>Products Reviewed</span>
                            </div>
                        </div>

                        <table class="reviews-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Difficulty</th>
                                    <th>User</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td data-label="Product">
                                            <span class="product-name">{{ $review->product->productName }}</span>
                                        </td>
                                        <td data-label="Difficulty">
                                            <span class="diff-badge {{ strtolower($review->product->productDifficulty) }}">
                                                {{ strtoupper($review->product->productDifficulty) }}
                                            </span>
                                        </td>
                                        <td data-label="User">{{ $review->user->firstName }} {{ $review->user->lastName }}</td>
                                        <td data-label="Rating">
                                            <span class="stars-wrap">
                                                <span class="stars-bg">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                                <span class="stars-fg" data-pct="{{ number_format(($review->rating / 5) * 100, 2) }}">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                            </span>
                                            {{ number_format($review->rating, 1) }}
                                        </td>
                                        <td data-label="Comment">
                                            @if($review->reviewComment)
                                                <span class="review-comment" title="{{ $review->reviewComment }}">
                                                    {{ $review->reviewComment }}
                                                </span>
                                            @else
                                                <span class="no-comment">No comment</span>
                                            @endif
                                        </td>
                                        <td data-label="Date">{{ $review->created_at->format('d M Y') }}</td>
                                        <td data-label="">
                                            <form action="{{ route('review_moderation.delete', $review->reviewID) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this review?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        @if($reviews->hasPages())
                            <div class="pagination-wrapper">
                                {{-- Previous --}}
                                @if($reviews->onFirstPage())
                                    <span class="disabled">&laquo;</span>
                                @else
                                    <a href="{{ $reviews->previousPageUrl() }}">&laquo;</a>
                                @endif

                                {{-- Page numbers --}}
                                @foreach($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                                    @if($page == $reviews->currentPage())
                                        <span class="active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                @endforeach

                                {{-- Next --}}
                                @if($reviews->hasMorePages())
                                    <a href="{{ $reviews->nextPageUrl() }}">&raquo;</a>
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
    <script>
        document.querySelectorAll('.stars-fg[data-pct]').forEach(function (el) {
            el.style.width = el.dataset.pct + '%';
        });
    </script>
</body>

</html>
