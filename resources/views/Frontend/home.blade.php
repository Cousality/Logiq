<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        /* HERO SECTION */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 70vh;
            padding: 0 5%;
            gap: 2rem;
            align-items: center;
            background: linear-gradient(135deg,
                    var(--bg-primary) 50%,
                    var(--red-pastel-1) 50%);
        }

        .hero-text h1 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--text);
            color: var(--white);
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .cta-button:hover {
            transform: translateY(-3px);
        }

        /* PUZZLE CARD */
        .puzzle-card {
            background: var(--white);
            padding: 2rem;
            border: 2px solid var(--text);
        }

        .puzzle-question {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .puzzle-options button {
            color: var(--text);
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            cursor: pointer;
            text-align: left;
        }

        .puzzle-options button:hover {
            background: var(--bg-secondary);
        }

        /* CATEGORIES SECTION */
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .divider {
            width: 100px;
            height: 4px;
            background: var(--red-pastel-1);
            margin: 0 auto;
        }

        .categories-section {
            padding: 6rem 5%;
            background: var(--bg-primary);
        }

        .category-carousel {
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .carousel-arrow {
            background: none;
            border: none;
            cursor: pointer;
            flex-shrink: 0;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.6;
            transition: opacity 0.2s;
        }

        .carousel-arrow:hover {
            opacity: 1;
        }

        .carousel-arrow svg {
            width: 28px;
            height: 28px;
            stroke: var(--text);
            stroke-width: 2.5;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .category-grid {
            overflow: hidden;
            flex: 1;
            padding-top: 14px;
            margin-top: -14px;
        }

        .category-track {
            display: flex;
            gap: 2.5rem;
            transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }

        .category-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            position: relative;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            min-height: 280px;
            min-width: 380px;
            max-width: 380px;
            flex-shrink: 0;
            text-decoration: none;
            color: inherit;
        }

        .category-card:hover,
        .rec-card:hover {
            transform: translateY(-5px);
            box-shadow: 8px 8px 0 var(--red-pastel-1);
        }

        .category-card::before,
        .rec-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--red-pastel-1);
        }

        .rec-card::before {
            z-index: 1;
        }

        .category-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--text);
            position: relative;
            padding-bottom: 0.8rem;
        }

        .category-name::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--red-pastel-1);
        }

        .category-bio {
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--text);
            flex-grow: 1;
        }

        #feedback {
            margin-top: 10px;
            font-weight: bold;
            min-height: 1.6em;
        }


        /* MOST RECOMMENDED SECTION */
        .recommended-section {
            padding: 6rem 5%;
            background: var(--bg-secondary);
        }

        .rec-card {
            background: var(--white);
            border: 2px solid var(--text);
            box-sizing: border-box;
            position: relative;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            width: 300px;
            flex-shrink: 0;
            text-decoration: none;
            color: inherit;
            overflow: hidden;
        }

        .rec-card-image {
            height: 200px;
            background: var(--bg-secondary);
            border-bottom: 2px solid var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .rec-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rec-card-image .rec-placeholder {
            font-size: 3.5rem;
        }

        .rec-card-body {
            padding: 1.25rem 1.25rem 1.25rem 1.6rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .rec-rank {
            font-size: 0.7rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--red-pastel-1);
            margin-bottom: 0.35rem;
        }

        .rec-name {
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
            margin-bottom: 0.4rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .rec-price {
            font-size: 1rem;
            font-weight: bold;
            color: var(--red-pastel-1);
            margin-bottom: 0.5rem;
        }

        .rec-rating {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: auto;
            padding-top: 0.5rem;
        }

        .rec-stars-wrap {
            position: relative;
            display: inline-block;
            font-size: 0.95rem;
            line-height: 1;
            white-space: nowrap;
        }

        .rec-stars-wrap .stars-bg {
            color: #ccc;
            letter-spacing: 1px;
        }

        .rec-stars-wrap .stars-fg {
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            white-space: nowrap;
            color: #c8871a;
            letter-spacing: 1px;
        }

        .rec-review-count {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text);
            opacity: 0.65;
        }

        .rec-difficulty-badge {
            position: absolute;
            top: 0;
            right: 0;
            color: #ffffff;
            padding: 0.35rem 0.7rem;
            font-size: 0.72rem;
            font-weight: bold;
            border-left: 2px solid var(--text);
            border-bottom: 2px solid var(--text);
            z-index: 10;
        }

        .rec-difficulty-badge.easy   { background: #4a7c59; }
        .rec-difficulty-badge.medium { background: #c17f24; }
        .rec-difficulty-badge.hard   { background: #a63232; }

        /* MOBILE FIXES */
        @media (max-width: 768px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                background: var(--bg-primary);
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }


            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="hero">
        <div class="hero-text">
            <h1>Don't Be The Problem.<br />Solve The Problem.</h1>
            <p>Puzzles go BRR.</p>
            <br />
            <a href="{{ route('store.index') }}" class="cta-button">Browse Store</a>
        </div>
        <div class="puzzle-card">
            <div class="puzzle-badge">DAILY LOGIQ</div>

            <div class="puzzle-question">Sequence: {{ $puzzle['sequence_string'] }}</div>

            <div class="puzzle-options">
                @foreach ($puzzle['options'] as $option)
                    <button class="option-btn" data-value="{{ $option }}">
                        {{ $option }}
                    </button>
                @endforeach
            </div>

            <div id="feedback"></div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </header>

    <section class="recommended-section">
        <div class="section-header">
            <h2>Most Recommended</h2>
            <div class="divider"></div>
        </div>

        <div class="category-carousel">
            <button class="carousel-arrow" id="rec-prev">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </button>

            <div class="category-grid" id="rec-grid">
                <div class="category-track" id="rec-track">
                    @forelse ($topProducts as $i => $product)
                        @php
                            $avgRating = $product->reviews_avg_rating ?? 0;
                            $starWidth = $product->reviews_count > 0 ? round(($avgRating / 5) * 100) : 0;
                        @endphp
                        <a href="{{ route('product.index', $product->productSlug) }}" class="rec-card">
                            <div class="rec-difficulty-badge {{ strtolower($product->productDifficulty) }}">
                                {{ strtoupper($product->productDifficulty) }}
                            </div>

                            <div class="rec-card-image">
                                @if ($product->productImage)
                                    <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}">
                                @else
                                    <span class="rec-placeholder">🧩</span>
                                @endif
                            </div>

                            <div class="rec-card-body">
                                <div class="rec-rank">#{{ $i + 1 }} Recommended</div>
                                <div class="rec-name">{{ $product->productName }}</div>
                                <div class="rec-price">£{{ number_format($product->productPrice, 2) }}</div>
                                <div class="rec-rating">
                                    <span class="rec-stars-wrap">
                                        <span class="stars-bg">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                        <span class="stars-fg" style="width: <?= $starWidth ?>%">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                    </span>
                                    <span class="rec-review-count">({{ $product->reviews_count ?? 0 }})</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p style="opacity:0.6; padding: 2rem;">No reviewed products yet.</p>
                    @endforelse
                </div>
            </div>

            <button class="carousel-arrow" id="rec-next">
                <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </section>

    <section class="categories-section">
            <div class="section-header">
                <h2>Shop By Category</h2>
                <div class="divider"></div>
            </div>

            <div class="category-carousel">
                <button class="carousel-arrow" id="cat-prev">
                    <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                </button>

                <div class="category-grid" id="category-grid">
                    <div class="category-track" id="category-track">

                    <a href="{{ route('store.index') }}?category=Twist" class="category-card">
                        <div class="category-name">Twist</div>
                        <div class="category-bio">Rubik's cubes, Pyraminx, Speedcubes and more. Challenge your dexterity and spatial reasoning with our range of twisty puzzles.</div>
                    </a>

                    <a href="{{ route('store.index') }}?category=Jigsaw" class="category-card">
                        <div class="category-name">Jigsaw</div>
                        <div class="category-bio">From 100 to 1000 pieces, our jigsaw collection features iconic landmarks from around the world — perfect for solo or group sessions.</div>
                    </a>

                    <a href="{{ route('store.index') }}?category=Word%26Number" class="category-card">
                        <div class="category-name">Word&amp;Number</div>
                        <div class="category-bio">Sudoku, crosswords, Scrabble, word searches and nonograms. Exercise your vocabulary and numerical logic in equal measure.</div>
                    </a>

                    <a href="{{ route('store.index') }}?category=BoardGames" class="category-card">
                        <div class="category-name">BoardGames</div>
                        <div class="category-bio">Chess, Monopoly, Cluedo and more. Classic strategy and social games that bring people together around the table.</div>
                    </a>

                    <a href="{{ route('store.index') }}?category=HandheldBrainTeasers" class="category-card">
                        <div class="category-name">HandheldBrainTeasers</div>
                        <div class="category-bio">Compact mechanical puzzles you can take anywhere. Wooden burr puzzles and interlocking challenges for the dedicated thinker.</div>
                    </a>

                    </div>
                </div>

                <button class="carousel-arrow" id="cat-next">
                    <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
            </div>
        </section>

    @include('Frontend.components.footer')
    <script>
        function makeCarousel(trackId, cardSelector, prevId, nextId, step) {
            const track    = document.getElementById(trackId);
            const originals = Array.from(track.querySelectorAll(cardSelector));
            if (originals.length === 0) return;
            const count = originals.length;

            originals.forEach(c => track.appendChild(c.cloneNode(true)));

            const cards = track.querySelectorAll(cardSelector);
            let current = 0;
            let busy = false;

            function cStep()  { return cards[1].offsetLeft - cards[0].offsetLeft; }

            function setPos(index, animate) {
                if (!animate) track.style.transition = 'none';
                track.style.transform = `translateX(-${index * cStep()}px)`;
                if (!animate) requestAnimationFrame(() => track.style.transition = '');
                current = index;
            }

            document.getElementById(nextId).addEventListener('click', () => {
                if (busy) return;
                busy = true;
                setPos(current + step, true);
                setTimeout(() => {
                    if (current >= count) setPos(current - count, false);
                    busy = false;
                }, 450);
            });

            document.getElementById(prevId).addEventListener('click', () => {
                if (busy) return;
                busy = true;
                if (current - step < 0) {
                    setPos(current + count, false);
                    requestAnimationFrame(() => requestAnimationFrame(() => {
                        setPos(current - step, true);
                        setTimeout(() => { busy = false; }, 450);
                    }));
                } else {
                    setPos(current - step, true);
                    setTimeout(() => { busy = false; }, 450);
                }
            });
        }

        makeCarousel('rec-track',      '.rec-card',      'rec-prev',  'rec-next',  2);
        makeCarousel('category-track', '.category-card', 'cat-prev',  'cat-next',  2);
    </script>
    <script>
        document.querySelectorAll(".option-btn").forEach((button) => {
            button.addEventListener("click", function() {
                const answer = this.getAttribute("data-value");
                submitAnswer(answer);
            });
        });

        function submitAnswer(val) {
            const feedback = document.getElementById("feedback");
            const btns = document.querySelectorAll(".option-btn");

            // Disable buttons
            btns.forEach((btn) => (btn.disabled = true));
            feedback.textContent = "Analyzing...";
            feedback.style.color = "var(--text)";

            fetch("{{ route('puzzle.check') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({
                        answer: val,
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    feedback.style.color = data.color;
                    feedback.textContent = data.message;

                    if (data.status === "error") {
                        setTimeout(() => {
                            btns.forEach((btn) => (btn.disabled = false));
                            feedback.textContent = "";
                        }, 2000);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    feedback.textContent = "System Error.";
                });
        }
    </script>

</body>

</html>
