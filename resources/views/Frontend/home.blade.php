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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: var(--white);
            border: 1px solid var(--red-pastel-2);
            transition: 0.3s;
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
            <h1>Don't Solve A Problem.<br />Be The Problem.</h1>
            <p>Puzzles go BRR</p>
            <br />
            <a href="#" class="cta-button">Browse Store</a>
        </div>
        <div class="puzzle-card">
            <div class="puzzle-badge">DAILY LOGIQ #1</div>
            <div class="puzzle-question">Sequence: 2, 4, 6, 8, 10, ?</div>
            <div class="puzzle-options">
                <button onclick="checkAnswer(12)">12</button>
                <button onclick="checkAnswer(14)">14</button>
                <button onclick="checkAnswer(16)">16</button>
            </div>
            <div id="feedback"></div>
        </div>
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
        </div>
    </section>


    @include('Frontend.components.footer')
    <script>
        function checkAnswer(val) {
            const feedback = document.getElementById("feedback");
            const btns = document.querySelectorAll(".puzzle-options button");
            if (val === 12) {
                feedback.style.color = "green";
                feedback.textContent = "Correct. Logic sound.";
                btns.forEach((btn) => (btn.disabled = true));
            } else {
                feedback.style.color = "#4A2C2A";
                feedback.textContent = "Incorrect. Think sequentially.";
            }
        }
    </script>
</body>

</html>
