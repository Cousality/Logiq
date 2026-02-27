<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/product-reviews.css') }}" />
    <style>
        /* PRODUCT HEADER */
        .product-header {
            padding: 3rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .breadcrumb {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.8;
            text-transform: uppercase;
        }

        .breadcrumb a {
            color: var(--text);
            text-decoration: none;
            font-weight: bold;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* PRODUCT CONTAINER */
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            padding: 3rem 5%;
            margin-bottom: 3rem;
        }

        /* IMAGE SECTION */
        .product-image-container {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .product-image {
            background: var(--white);
            border: 2px solid var(--text);
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* INFO SECTION */
        .product-info-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .product-details-section {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 0.5rem;
            line-height: 1.1;
        }

        .product-price {
            font-size: 2rem;
            font-weight: bold;
            color: var(--red-pastel-1);
            margin-bottom: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid var(--text);
        }

        .product-description {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* PRODUCT ACTIONS */
        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid var(--text);
        }

        .add-to-basket,
        .add-to-wishlist {
            width: 100%;
            padding: 1rem;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--text);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
        }

        .add-to-basket {
            background: var(--text);
            color: var(--bg-primary);
        }

        .add-to-basket:hover {
            background: var(--red-pastel-1);
            color: var(--white);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--text);
        }

        .add-to-wishlist {
            background: var(--bg-primary);
            color: var(--text);
        }

        .add-to-wishlist:hover {
            background: var(--bg-secondary);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--text);
        }

        /* INFO ROWS */
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            align-items: center;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .info-value {
            font-weight: 600;
        }

        /* BADGES */
        .badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid var(--text);
        }

        .badge-success {
            background: var(--bg-secondary);
            color: var(--text);
        }

        .badge-danger {
            background: var(--red-pastel-1);
            color: var(--white);
        }

        /* STAR DISPLAY */
        .rating-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars-wrap {
            position: relative;
            display: inline-block;
            font-size: 1.4rem;
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

        .review-count {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
            opacity: 0.75;
        }

        /* REVIEWS SECTION */
        .reviews-section {
            padding: 0 5% 4rem;
        }

        .reviews-heading {
            font-size: 1.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--text);
        }

        .reviews-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 3rem;
        }

        /* Leave-a-review panel */
        .leave-review-panel {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 1.8rem;
            height: fit-content;
        }

        .leave-review-panel h3 {
            font-size: 1.1rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 1.2rem;
        }

        /* STAR PICKER */
        .star-picker-label {
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            opacity: 0.7;
        }

        .star-picker {
            display: flex;
            cursor: pointer;
            user-select: none;
            margin-bottom: 0.5rem;
            width: fit-content;
            gap: 2px;
        }

        .star-picker .sp-star {
            position: relative;
            font-size: 2.4rem;
            line-height: 1;
            color: #ccc;
            transition: color 0.07s;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            cursor: pointer;
        }

        .star-picker .sp-star.half-lit {
            background: linear-gradient(to right, #c8871a 50%, #ccc 50%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .star-picker .sp-star.full-lit {
            color: #c8871a;
            -webkit-text-fill-color: #c8871a;
            background: none;
            background-clip: unset;
            -webkit-background-clip: unset;
        }

        .star-picker-value {
            font-size: 0.9rem;
            font-weight: bold;
            margin-left: 0.6rem;
            align-self: center;
            color: var(--text);
            opacity: 0.75;
            min-width: 3rem;
        }

        .review-current-label {
            font-size: 0.8rem;
            opacity: 0.65;
            margin-bottom: 0.8rem;
        }

        /* REVIEW LIST */
        .review-list {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .review-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 1.4rem;
        }

        .review-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem;
        }

        .review-card-author {
            font-weight: 900;
            font-size: 0.95rem;
            text-transform: uppercase;
        }

        .review-card-date {
            font-size: 0.8rem;
            opacity: 0.55;
        }

        .review-card-stars {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .review-card-comment {
            font-size: 0.95rem;
            line-height: 1.55;
            opacity: 0.85;
        }

        .no-reviews-msg {
            font-size: 1rem;
            opacity: 0.6;
            padding: 2rem 0;
        }

        /* CONFIRM MODAL */
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
            max-width: 480px;
            box-shadow: 6px 6px 0px var(--text);
            position: relative;
        }

        .modal-box h2 {
            font-size: 1.4rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .modal-preview-stars {
            font-size: 2.2rem;
            margin: 1rem 0 0.4rem;
            letter-spacing: 2px;
        }

        .modal-rating-label {
            font-size: 0.9rem;
            font-weight: bold;
            opacity: 0.7;
            margin-bottom: 1.4rem;
        }

        .modal-comment-label {
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }

        .modal-comment-input {
            width: 100%;
            min-height: 90px;
            resize: vertical;
            border: 2px solid var(--text);
            background: var(--white);
            color: var(--text);
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            outline: none;
        }

        .modal-comment-input:focus {
            box-shadow: 3px 3px 0 var(--text);
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
        }

        .modal-confirm-btn,
        .modal-cancel-btn {
            flex: 1;
            padding: 0.85rem;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid var(--text);
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .modal-confirm-btn {
            background: var(--text);
            color: var(--bg-primary);
        }

        .modal-confirm-btn:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
            color: var(--white);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--text);
        }

        .modal-cancel-btn {
            background: var(--bg-primary);
            color: var(--text);
        }

        .modal-cancel-btn:hover {
            background: var(--bg-secondary);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0 var(--text);
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

        /* TOAST */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--text);
            color: var(--bg-primary);
            padding: 1rem 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85rem;
            border: 2px solid var(--text);
            z-index: 2000;
            opacity: 0;
            transform: translateY(1rem);
            transition: opacity 0.3s ease, transform 0.3s ease;
            pointer-events: none;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
            }

            .product-image-container {
                position: relative;
                top: 0;
            }

            .product-header {
                background: var(--bg-primary);
            }

            .reviews-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <div class="product-container">
        <div class="product-image-container">
            <div class="product-image">
                @if ($product->productImage)
                    <img src="{{ $product->imageUrl }}" alt="{{ $product->productName }}"
                        style="height: 100%; width: 100%;">
                @else
                    Product Image
                @endif
            </div>
        </div>

        <div class="product-info-container">
            <div class="product-details-section">
                <h1 class="product-title">{{ $product->productName }}</h1>

                <div style="margin-bottom: 0.5rem;">
                    <span class="rating-display" id="avg-rating-display">
                        <span class="stars-wrap"><span class="stars-bg">&#9733;&#9733;&#9733;&#9733;&#9733;</span><span
                                class="stars-fg" id="avg-stars-fg"
                                data-pct="{{ isset($avgRating) && $reviewCount > 0 ? (int) number_format(($avgRating / 5) * 100, 2) : 0 }}">&#9733;&#9733;&#9733;&#9733;&#9733;</span></span>
                        <span class="review-count" id="review-count-label">({{ $reviewCount ?? 0 }})</span>
                    </span>
                </div>

                <div class="product-price">£{{ number_format($product->productPrice, 2) }}</div>

                <div class="product-description">
                    <p>{{ $product->productDescription }}</p>
                </div>

                <div class="product-actions">
                    <form action="{{ route('basket.add') }}" method="POST" style="margin-bottom: 0.5rem;">
                        @csrf
                        <input type="hidden" name="productID" value="{{ $product->productID }}">

                        <button type="submit" class="add-to-basket">
                            Add to Basket
                        </button>
                    </form>
                    <form action="{{ route('wishlist.add') }}" method="POST" style="margin-bottom: 0.5rem;">
                        @csrf
                        <input type="hidden" name="productID" value="{{ $product->productID }}">

                        <button type="submit" class="add-to-wishlist">
                            Wishlist
                        </button>
                    </form>
                </div>

                <div class="info-row">
                    <span class="info-label">Availability:</span>
                    <span class="info-value">
                        @if ($product->productQuantity > 0)
                            <span class="badge badge-success">In Stock ({{ $product->productQuantity }})</span>
                        @else
                            <span class="badge badge-danger">Out of Stock</span>
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Category:</span>
                    <span class="info-value">{{ ucfirst($product->productCategory) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Difficulty:</span>
                    <span class="info-value">{{ ucfirst($product->productDifficulty) }}</span>
                </div>

            </div>
        </div>
    </div>

    {{-- REVIEWS --}}
    <div class="reviews-section">
        <h2 class="reviews-heading">Reviews</h2>

        <div class="reviews-layout">

            {{-- Leave a review --}}
            <div class="leave-review-panel">
                @auth
                    <h3>
                        @if (isset($userReview) && $userReview)
                            Update Your Review
                        @else
                            Leave a Review
                        @endif
                    </h3>

                    @if (isset($userReview) && $userReview)
                        <p class="review-current-label">Your current rating:
                            <strong>{{ number_format($userReview->rating, 1) }} / 5.0</strong>
                        </p>
                    @endif

                    <div style="display:flex; align-items:center;">
                        <div class="star-picker" id="starPicker" data-product="{{ $product->productID }}"
                            data-current="{{ isset($userReview) && $userReview ? $userReview->rating : 0 }}">
                            <span class="sp-star" data-index="1">&#9733;</span>
                            <span class="sp-star" data-index="2">&#9733;</span>
                            <span class="sp-star" data-index="3">&#9733;</span>
                            <span class="sp-star" data-index="4">&#9733;</span>
                            <span class="sp-star" data-index="5">&#9733;</span>
                        </div>
                        <span class="star-picker-value" id="pickerValueLabel">&nbsp;</span>
                    </div>
                @else
                    <h3>Leave a Review</h3>
                    <p style="font-size:0.9rem; opacity:0.7; line-height:1.6;">
                        <a href="{{ route('login') }}" style="color: var(--red-pastel-1); font-weight:bold;">Log in</a>
                        to leave a review for this product.
                    </p>
                @endauth
            </div>

            {{-- RIGHT: Existing reviews --}}
            <div style="max-height: 480px; overflow-y: auto; padding-right: 0.5rem;">
                @if (isset($reviews) && $reviews->count() > 0)
                    <div class="review-list" id="reviewList">
                        @foreach ($reviews as $review)
                            <div class="review-card">
                                <div class="review-card-header">
                                    <span class="review-card-author">
                                        {{ $review->user ? $review->user->firstName . ' ' . substr($review->user->lastName, 0, 1) . '.' : 'Anonymous' }}
                                    </span>
                                    <span class="review-card-date">{{ $review->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="review-card-stars">
                                    <span class="stars-wrap"><span
                                            class="stars-bg">&#9733;&#9733;&#9733;&#9733;&#9733;</span><span
                                            class="stars-fg"
                                            data-pct="{{ number_format(($review->rating / 5) * 100, 2) }}">&#9733;&#9733;&#9733;&#9733;&#9733;</span></span>
                                </div>
                                @if ($review->reviewComment)
                                    <p class="review-card-comment">{{ $review->reviewComment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-reviews-msg">No reviews yet — be the first to share your thoughts!</p>
                @endif
            </div>

        </div>
    </div>

    {{-- CONFIRM MODAL --}}
    <div class="modal-overlay" id="reviewModal">
        <div class="modal-box">
            <button class="modal-close" id="modalClose" aria-label="Close">&times;</button>
            <h2>Confirm Your Review</h2>
            <p class="star-picker-label" style="margin-top:1rem;">Rating</p>
            <div style="display:flex; align-items:center; margin-bottom:0.4rem;">
                <div class="star-picker" id="modalStarPicker">
                    <span class="sp-star" data-index="1">&#9733;</span>
                    <span class="sp-star" data-index="2">&#9733;</span>
                    <span class="sp-star" data-index="3">&#9733;</span>
                    <span class="sp-star" data-index="4">&#9733;</span>
                    <span class="sp-star" data-index="5">&#9733;</span>
                </div>
                <span class="star-picker-value" id="modalPickerValueLabel">&nbsp;</span>
            </div>
            <p class="modal-rating-label" id="modalRatingLabel"></p>
            <p class="modal-comment-label">Comment <span style="font-weight:normal; opacity:0.6;">(optional)</span>
            </p>
            <textarea class="modal-comment-input" id="modalComment" placeholder="Share your thoughts about this product..."></textarea>
            <div class="modal-actions">
                <button class="modal-confirm-btn" id="modalConfirm">Confirm Review</button>
                <button class="modal-cancel-btn" id="modalCancel">Cancel</button>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    @include('Frontend.components.footer')

    <script>
        (function() {
            // Initialise star widths
            document.querySelectorAll('[data-pct]').forEach(function(el) {
                el.style.width = el.dataset.pct + '%';
            });

            // Render star HTML for modal preview
            function renderStarsHTML(rating) {
                var html = '';
                for (var i = 1; i <= 5; i++) {
                    if (rating >= i) {
                        html += '<span style="color:#c8871a;">&#9733;</span>';
                    } else if (rating >= i - 0.5) {
                        html += '<span style="background:linear-gradient(to right,#c8871a 50%,#ccc 50%);' +
                            '-webkit-background-clip:text;-webkit-text-fill-color:transparent;' +
                            'background-clip:text;">&#9733;</span>';
                    } else {
                        html += '<span style="color:#ccc;">&#9733;</span>';
                    }
                }
                return html;
            }

            function showToast(msg) {
                var t = document.getElementById('toast');
                if (!t) return;
                t.textContent = msg;
                t.classList.add('show');
                setTimeout(function() {
                    t.classList.remove('show');
                }, 3000);
            }

            var picker = document.getElementById('starPicker');
            if (!picker) return;

            var stars = Array.from(picker.querySelectorAll('.sp-star'));
            var valueLabel = document.getElementById('pickerValueLabel');
            var hoveredRating = 0;
            var pendingRating = 0;

            // Show current saved rating on load
            var saved = parseFloat(picker.dataset.current) || 0;
            if (saved > 0) {
                applyPickerDisplay(saved);
                valueLabel.textContent = saved.toFixed(1) + ' / 5';
            }

            picker.addEventListener('mousemove', function(e) {
                var rect = picker.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var frac = x / rect.width; // 0..1
                var raw = Math.max(1, Math.round(frac * 10)); // 1..10 half-steps
                hoveredRating = raw / 2; // 0.5..5.0
                applyPickerDisplay(hoveredRating);
                valueLabel.textContent = hoveredRating.toFixed(1) + ' / 5';
            });

            picker.addEventListener('mouseleave', function() {
                var s = parseFloat(picker.dataset.current) || 0;
                applyPickerDisplay(s);
                valueLabel.textContent = s > 0 ? s.toFixed(1) + ' / 5' : '\u00a0';
                hoveredRating = 0;
            });

            picker.addEventListener('click', function() {
                if (hoveredRating > 0) {
                    pendingRating = hoveredRating;
                    openModal(pendingRating);
                }
            });

            function applyPickerDisplay(rating) {
                stars.forEach(function(star, i) {
                    var n = i + 1;
                    // Reset
                    star.classList.remove('half-lit', 'full-lit');
                    star.style.cssText = '';

                    if (rating >= n) {
                        star.classList.add('full-lit');
                    } else if (rating >= n - 0.5) {
                        star.classList.add('half-lit');
                    }
                });
            }

            /* ---- Modal ---- */
            var modal = document.getElementById('reviewModal');
            var ratingLabel = document.getElementById('modalRatingLabel');
            var confirmBtn = document.getElementById('modalConfirm');
            var cancelBtn = document.getElementById('modalCancel');
            var closeBtn = document.getElementById('modalClose');
            var commentInput = document.getElementById('modalComment');
            var modalPicker = document.getElementById('modalStarPicker');
            var modalPickerStars = Array.from(modalPicker.querySelectorAll('.sp-star'));
            var modalValueLabel = document.getElementById('modalPickerValueLabel');
            var modalHoveredRating = 0;

            function applyModalPickerDisplay(rating) {
                modalPickerStars.forEach(function(star, i) {
                    var n = i + 1;
                    star.classList.remove('half-lit', 'full-lit');
                    star.style.cssText = '';
                    if (rating >= n) {
                        star.classList.add('full-lit');
                    } else if (rating >= n - 0.5) {
                        star.classList.add('half-lit');
                    }
                });
            }

            modalPicker.addEventListener('mousemove', function(e) {
                var rect = modalPicker.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var frac = x / rect.width;
                var raw = Math.max(1, Math.round(frac * 10));
                modalHoveredRating = raw / 2;
                applyModalPickerDisplay(modalHoveredRating);
                modalValueLabel.textContent = modalHoveredRating.toFixed(1) + ' / 5';
                ratingLabel.textContent = 'Rating: ' + modalHoveredRating.toFixed(1) + ' / 5.0';
            });

            modalPicker.addEventListener('mouseleave', function() {
                applyModalPickerDisplay(pendingRating);
                modalValueLabel.textContent = pendingRating > 0 ? pendingRating.toFixed(1) + ' / 5' : '\u00a0';
                ratingLabel.textContent = pendingRating > 0 ? 'Rating: ' + pendingRating.toFixed(1) + ' / 5.0' :
                    '';
                modalHoveredRating = 0;
            });

            modalPicker.addEventListener('click', function() {
                if (modalHoveredRating > 0) {
                    pendingRating = modalHoveredRating;
                    applyModalPickerDisplay(pendingRating);
                    modalValueLabel.textContent = pendingRating.toFixed(1) + ' / 5';
                    ratingLabel.textContent = 'Rating: ' + pendingRating.toFixed(1) + ' / 5.0';
                }
            });

            function openModal(rating) {
                pendingRating = rating;
                applyModalPickerDisplay(rating);
                modalValueLabel.textContent = rating.toFixed(1) + ' / 5';
                ratingLabel.textContent = 'Rating: ' + rating.toFixed(1) + ' / 5.0';
                commentInput.value = '';
                modal.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
                pendingRating = 0;
            }

            cancelBtn.addEventListener('click', closeModal);
            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });

            confirmBtn.addEventListener('click', function() {
                if (!pendingRating) return;

                var productID = picker.dataset.product;
                var comment = commentInput.value.trim();

                confirmBtn.disabled = true;
                confirmBtn.textContent = 'Saving\u2026';

                fetch('{{ route('reviews.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            productID: parseInt(productID),
                            rating: pendingRating,
                            reviewComment: comment || null
                        })
                    })
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        confirmBtn.disabled = false;
                        confirmBtn.textContent = 'Confirm Review';

                        if (data.success) {
                            picker.dataset.current = pendingRating.toFixed(1);
                            applyPickerDisplay(pendingRating);
                            valueLabel.textContent = pendingRating.toFixed(1) + ' / 5';

                            /* Update avg rating row */
                            var avgDisplay = document.getElementById('avg-rating-display');
                            var countLabel = document.getElementById('review-count-label');
                            if (avgDisplay) {
                                var fg = avgDisplay.querySelector('.stars-fg');
                                if (fg) {
                                    fg.style.width = ((data.avgRating / 5) * 100).toFixed(2) + '%';
                                }
                                if (countLabel) {
                                    countLabel.textContent = '(' + data.reviewCount + ')';
                                }
                            }

                            closeModal();
                            showToast('Review saved!');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1200);
                        } else {
                            showToast(data.message || 'Something went wrong.');
                            closeModal();
                        }
                    })
                    .catch(function() {
                        confirmBtn.disabled = false;
                        confirmBtn.textContent = 'Confirm Review';
                        showToast('Network error. Please try again.');
                        closeModal();
                    });
            });

        })();
    </script>
</body>

</html>
