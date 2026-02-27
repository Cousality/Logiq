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
            table-layout: fixed;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .reviews-table th {
            background: var(--text);
            color: var(--text-light);
            padding: 0.6rem 0.75rem;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .reviews-table td {
            padding: 0.6rem 0.75rem;
            border-bottom: 1px solid var(--bg-secondary);
            vertical-align: middle;
            word-break: break-word;
        }

        .reviews-table tr:last-child td {
            border-bottom: none;
        }

        .reviews-table tr:hover td {
            background: var(--bg-secondary);
        }

        .product-name {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.82rem;
        }

        /* Difficulty badge */
        .diff-badge {
            font-size: 0.7rem;
            font-weight: bold;
            text-transform: uppercase;
            padding: 2px 8px;
            border: 2px solid var(--text);
            color: #fff;
            white-space: nowrap;
        }

        .diff-badge.easy   { background: #4a7c59; }
        .diff-badge.medium { background: #c17f24; }
        .diff-badge.hard   { background: #a63232; }

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
        .btn-delete {
            background: transparent;
            color: #a63232;
            border: 2px solid #a63232;
            padding: 0.35rem 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.78rem;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }

        .btn-delete:hover {
            background: #a63232;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; }
            .moderation-container { padding: 1rem; }
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
                                <strong>{{ $reviews->count() }}</strong>
                                <span>Total Reviews</span>
                            </div>
                            <div class="summary-stat">
                                <strong>{{ number_format($reviews->avg('rating'), 1) }}</strong>
                                <span>Avg Rating</span>
                            </div>
                            <div class="summary-stat">
                                <strong>{{ $reviews->pluck('productID')->unique()->count() }}</strong>
                                <span>Products Reviewed</span>
                            </div>
                        </div>

                        <table class="reviews-table">
                            <colgroup>
                                <col style="width:17%"> <!-- Product -->
                                <col style="width:11%"> <!-- Difficulty -->
                                <col style="width:13%"> <!-- User -->
                                <col style="width:16%"> <!-- Rating -->
                                <col style="width:17%"> <!-- Comment -->
                                <col style="width:13%"> <!-- Date -->
                                <col style="width:13%"> <!-- Delete -->
                            </colgroup>
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
                                        <td>
                                            <span class="product-name">{{ $review->product->productName }}</span>
                                        </td>
                                        <td>
                                            <span class="diff-badge {{ strtolower($review->product->productDifficulty) }}">
                                                {{ strtoupper($review->product->productDifficulty) }}
                                            </span>
                                        </td>
                                        <td>{{ $review->user->firstName }} {{ $review->user->lastName }}</td>
                                        <td style="white-space:nowrap">
                                            <span class="stars-wrap">
                                                <span class="stars-bg">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                                <span class="stars-fg" data-pct="{{ number_format(($review->rating / 5) * 100, 2) }}">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                            </span>
                                            {{ number_format($review->rating, 1) }}
                                        </td>
                                        <td>
                                            @if($review->reviewComment)
                                                <span class="review-comment" title="{{ $review->reviewComment }}">
                                                    {{ $review->reviewComment }}
                                                </span>
                                            @else
                                                <span class="no-comment">No comment</span>
                                            @endif
                                        </td>
                                        <td style="white-space:nowrap">{{ $review->created_at->format('d M Y') }}</td>
                                        <td>
                                            <form action="{{ route('review_moderation.delete', $review->reviewID) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this review?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
