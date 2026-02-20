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

        /* PRODUCT GRID */
        .products {
            padding: 5rem 5%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .grid {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            scroll-behavior: smooth;
        }

        .grid::-webkit-scrollbar {
        height: 8px;
        }

        .grid::-webkit-scrollbar-thumb {
        background: var(--red-pastel-2);
        }

        .product-card {
            background: var(--white);
            border: 1px solid var(--red-pastel-2);
            transition: 0.3s;
            min-width: 250px;
            flex: 0 0 auto;
        }

        .product-card:hover {
            box-shadow: 5px 5px 0px var(--text);
        }

        .product-image {
            height: 200px;
            background-color: var(--red-pastel-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .product-info {
            padding: 1.5rem;
        }

        .price {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            font-size: 1.2rem;
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

    <section class="products">
        <h2 class="section-title">Categories</h2>
        <div class="grid">
            <div class="product-card">
                <div class="product-image">Placeholder</div>
                <div class="product-info">
                    <h3>PlaceHolder</h3>
                    <p>Difficulty: 9/10</p>
                    <span class="price">$00</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">PlaceHolder</div>
                <div class="product-info">
                    <h3>Cryptex Cylinder</h3>
                    <p>Difficulty: 7/10</p>
                    <span class="price">$00</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">PlaceHolder</div>
                <div class="product-info">
                    <h3>PlaceHolder</h3>
                    <p>PlaceHolder</p>
                    <span class="price">$00</span>
                </div>
            </div>
            <div class="product-card"> ... </div>
            <div class="product-card"> ... </div>
            <div class="product-card"> ... </div>
            <div class="product-card"> ... </div>
            <div class="product-card"> ... </div>
        </div>
    </section>


    @include('Frontend.components.footer')
    <script>
        document.querySelectorAll('.option-btn').forEach(button => {
            button.addEventListener('click', function() {
                const answer = this.getAttribute('data-value');
                submitAnswer(answer);
            });
        });

        function submitAnswer(val) {
            const feedback = document.getElementById("feedback");
            const btns = document.querySelectorAll(".option-btn");

            // Disable buttons Temp
            btns.forEach(btn => btn.disabled = true);
            feedback.textContent = "Analyzing...";
            feedback.style.color = "var(--text)";

            fetch("{{ route('puzzle.check') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        answer: val
                    })
                })
                .then(response => response.json())
                .then(data => {
                    feedback.style.color = data.color;
                    feedback.textContent = data.message;

                    if (data.status === 'error') {
                        setTimeout(() => {
                            btns.forEach(btn => btn.disabled = false);
                            feedback.textContent = "";
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    feedback.textContent = "System Error.";
                });
        }
    </script>
</body>

</html>
