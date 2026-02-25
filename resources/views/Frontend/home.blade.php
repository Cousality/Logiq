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
            font-family: inherit;
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
            background: var(--bg-secondary);
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

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 8px 8px 0 var(--red-pastel-1);
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--red-pastel-1);
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

            <div class="puzzle-options" id="puzzle-options-container">
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
        // Infinite category carousel
        const catGrid = document.getElementById('category-grid');
        const track = document.getElementById('category-track');
        const originals = Array.from(track.querySelectorAll('.category-card'));
        const count = originals.length;
        const step = 2;

        // Centre cards so both arrows are equidistant from the nearest card
        const cardW  = originals[0].offsetWidth;
        const gapPx  = parseFloat(getComputedStyle(track).gap);
        const cStep  = cardW + gapPx;
        const visible = Math.floor((catGrid.offsetWidth + gapPx) / cStep);
        const remainder = catGrid.offsetWidth - (visible * cardW + (visible - 1) * gapPx);
        track.style.paddingLeft = (remainder / 2) + 'px';

        // Append clones: [0,1,2,3,4, 0',1',2',3',4']
        originals.forEach(c => track.appendChild(c.cloneNode(true)));

        const cards = track.querySelectorAll('.category-card');
        let current = 0;
        let busy = false;

        function cardStep() {
            return cards[1].offsetLeft - cards[0].offsetLeft;
        }

        function setPosition(index, animate) {
            if (!animate) track.style.transition = 'none';
            track.style.transform = `translateX(-${index * cardStep()}px)`;
            if (!animate) requestAnimationFrame(() => track.style.transition = '');
            current = index;
        }

        function next() {
            if (busy) return;
            busy = true;
            setPosition(current + step, true);
            setTimeout(() => {
                if (current >= count) setPosition(current - count, false);
                busy = false;
            }, 450);
        }

        function prev() {
            if (busy) return;
            busy = true;
            if (current - step < 0) {
                setPosition(current + count, false);
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    setPosition(current - step, true);
                    setTimeout(() => { busy = false; }, 450);
                }));
            } else {
                setPosition(current - step, true);
                setTimeout(() => { busy = false; }, 450);
            }
        }

        document.getElementById('cat-prev').addEventListener('click', prev);
        document.getElementById('cat-next').addEventListener('click', next);
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

            // Disable buttons Temp
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
