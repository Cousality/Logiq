<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Puzzles - LOGIQ</title>
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

        .dashboard-content {
            flex: 1;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .myPuzzles-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            box-shadow: 10px 10px 0px var(--red-pastel-1);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }

        .empty-puzzles {
            text-align: center;
            padding: 50px 0;
            color: var(--text);
        }

        /* Flash message */
        .flash-success {
            background: #d4edda;
            border: 2px solid var(--text);
            color: #155724;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
            font-size: 0.95rem;
        }

        /* Puzzle cards */
        .puzzles-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .puzzle-card {
            border: 2px solid var(--text);
            background: var(--bg-primary);
        }

        .puzzle-card-inner {
            display: grid;
            grid-template-columns: 180px 1fr;
        }

        .puzzle-card-image {
            border-right: 2px solid var(--text);
            overflow: hidden;
            min-height: 180px;
        }

        .puzzle-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .puzzle-card-body {
            padding: 1.5rem;
        }

        .puzzle-card-title {
            font-size: 1.3rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            margin-bottom: 0.6rem;
        }

        .puzzle-card-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 1.2rem;
        }

        .badge {
            font-size: 0.72rem;
            font-weight: bold;
            text-transform: uppercase;
            padding: 2px 8px;
            border: 2px solid var(--text);
            letter-spacing: 0.5px;
        }

        .badge-category {
            background: var(--bg-secondary);
        }

        .badge-difficulty {
            color: #ffffff;
        }

        .badge-difficulty.easy {
            background: #4a7c59;
        }

        .badge-difficulty.medium {
            background: #c17f24;
        }

        .badge-difficulty.hard {
            background: #a63232;
        }

        .puzzle-form-label {
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
            display: block;
        }

        /* Star picker */
        .star-picker-wrap {
            margin-bottom: 1rem;
        }

        .sp-picker {
            display: flex;
            gap: 2px;
            margin-bottom: 0.3rem;
            cursor: default;
        }

        .sp-picker .sp-star {
            font-size: 1.8rem;
            color: #ccc;
            user-select: none;
            transition: color 0.1s;
            line-height: 1;
            cursor: pointer;
        }

        .sp-picker .sp-star.full-lit {
            color: var(--text);
        }

        .sp-picker .sp-star.half-lit {
            background: linear-gradient(to right, var(--text) 50%, #ccc 50%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sp-value {
            font-size: 0.82rem;
            opacity: 0.65;
        }

        /* Textarea */
        .review-textarea {
            width: 100%;
            min-height: 80px;
            border: 2px solid var(--text);
            background: var(--bg-primary);
            color: var(--text);
            padding: 0.5rem;
            font-family: inherit;
            font-size: 0.9rem;
            resize: vertical;
            box-sizing: border-box;
        }

        .review-textarea:focus {
            outline: none;
            box-shadow: 3px 3px 0 var(--red-pastel-1);
        }

        /* Submit button */
        .btn-update {
            margin-top: 0.8rem;
            background: var(--text);
            color: var(--text-light);
            border: 2px solid var(--text);
            padding: 0.5rem 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            transition: background 0.2s, border-color 0.2s;
        }

        .btn-update:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
        }

        .btn-delete {
            margin-top: 0.5rem;
            background: transparent;
            color: #a63232;
            border: 2px solid #a63232;
            padding: 0.5rem 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            transition: background 0.2s, color 0.2s;
        }

        .btn-delete:hover {
            background: #a63232;
            color: #ffffff;
        }

        .btn-row {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            margin-top: 0.8rem;
        }

        .btn-row .btn-update,
        .btn-row .btn-delete {
            margin-top: 0;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }

            .dashboard-layout {
                flex-direction: column;
            }
        }

        @media (max-width: 600px) {
            .puzzle-card-inner {
                grid-template-columns: 1fr;
            }

            .puzzle-card-image {
                border-right: none;
                border-bottom: 2px solid var(--text);
                max-height: 200px;
            }
        }

    </style>

</head>

<body>
    @include('Frontend.components.nav')
    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">My Puzzles</h1>
            <p>View and edit your reviewed and rated puzzles.</p>
        </header>

        <div class="dashboard-layout">
            @include('Frontend.components.dashboard_sidebar')
            <div class="dashboard-content">
                <div class="myPuzzles-container">
                    <h2 class="section-title">Your Past Reviews & Ratings</h2>

                    @if(session('success'))
                        <div class="flash-success">{{ session('success') }}</div>
                    @endif

                    @if($reviews->isEmpty())
                        <div class="empty-puzzles">
                            <h3>No reviewed puzzles found</h3>
                            <p>Once you leave a review, it will show up here.</p>
                        </div>
                    @else
                        <div class="puzzles-list">
                            @foreach($reviews as $review)
                                <div class="puzzle-card">
                                    <div class="puzzle-card-inner">
                                        <div class="puzzle-card-image">
                                            <img src="{{ $review->product->imageUrl }}"
                                                 alt="{{ $review->product->productName }}">
                                        </div>
                                        <div class="puzzle-card-body">
                                            <h3 class="puzzle-card-title">{{ $review->product->productName }}</h3>
                                            <div class="puzzle-card-badges">
                                                <span class="badge badge-category">{{ $review->product->productCategory }}</span>
                                                <span class="badge badge-difficulty {{ strtolower($review->product->productDifficulty) }}">{{ strtoupper($review->product->productDifficulty) }}</span>
                                            </div>

                                            <form action="{{ route('review.update', $review->reviewID) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="star-picker-wrap">
                                                    <label class="puzzle-form-label">Your Rating</label>
                                                    <div class="sp-picker"
                                                         id="picker-{{ $review->reviewID }}"
                                                         data-current="{{ $review->rating }}">
                                                        <span class="sp-star" data-index="1">&#9733;</span>
                                                        <span class="sp-star" data-index="2">&#9733;</span>
                                                        <span class="sp-star" data-index="3">&#9733;</span>
                                                        <span class="sp-star" data-index="4">&#9733;</span>
                                                        <span class="sp-star" data-index="5">&#9733;</span>
                                                    </div>
                                                    <span class="sp-value" id="val-{{ $review->reviewID }}">
                                                        {{ number_format($review->rating, 1) }} / 5.0
                                                    </span>
                                                    <input type="hidden"
                                                           name="rating"
                                                           id="rating-{{ $review->reviewID }}"
                                                           value="{{ $review->rating }}">
                                                </div>

                                                <div>
                                                    <label class="puzzle-form-label"
                                                           for="comment-{{ $review->reviewID }}">Your Review</label>
                                                    <textarea class="review-textarea"
                                                              id="comment-{{ $review->reviewID }}"
                                                              name="reviewComment"
                                                              placeholder="Write your review here...">{{ $review->reviewComment }}</textarea>
                                                </div>

                                                <div class="btn-row">
                                                    <button type="submit" class="btn-update">Update Review</button>

                                                    <form action="{{ route('review.delete', $review->reviewID) }}" method="POST"
                                                          onsubmit="return confirm('Are you sure you want to delete this review?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-delete">Delete Review</button>
                                                    </form>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    @include('Frontend.components.footer')

    <script>
        document.querySelectorAll('.sp-picker').forEach(function (picker) {
            var id = picker.id.replace('picker-', '');
            var stars = Array.from(picker.querySelectorAll('.sp-star'));
            var hiddenInput = document.getElementById('rating-' + id);
            var valueLabel = document.getElementById('val-' + id);
            var currentRating = parseFloat(picker.dataset.current) || 0;

            function applyDisplay(rating) {
                stars.forEach(function (star, i) {
                    var n = i + 1;
                    star.classList.remove('full-lit', 'half-lit');
                    if (rating >= n) {
                        star.classList.add('full-lit');
                    } else if (rating >= n - 0.5) {
                        star.classList.add('half-lit');
                    }
                });
                valueLabel.textContent = rating.toFixed(1) + ' / 5.0';
            }

            applyDisplay(currentRating);

            picker.addEventListener('mousemove', function (e) {
                var star = e.target.closest('.sp-star');
                if (!star) return;
                var rect = star.getBoundingClientRect();
                var isHalf = e.clientX < rect.left + rect.width / 2;
                var index = parseInt(star.dataset.index);
                applyDisplay(isHalf ? index - 0.5 : index);
            });

            picker.addEventListener('mouseleave', function () {
                applyDisplay(currentRating);
            });

            picker.addEventListener('click', function (e) {
                var star = e.target.closest('.sp-star');
                if (!star) return;
                var rect = star.getBoundingClientRect();
                var isHalf = e.clientX < rect.left + rect.width / 2;
                var index = parseInt(star.dataset.index);
                currentRating = isHalf ? index - 0.5 : index;
                hiddenInput.value = currentRating;
                applyDisplay(currentRating);
            });
        });
    </script>
</body>

</html>
