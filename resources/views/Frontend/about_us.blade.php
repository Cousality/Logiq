<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
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

        .section-line {
            width: 100%;
            height: 1px;
            background-color: var(--text);
            margin: 0 auto;
            opacity: 1;
        }

        .divider {
            width: 100px;
            height: 4px;
            background: var(--red-pastel-1);
            margin: 0 auto;
        }

        main h1 {
            font-size: 4rem;
            text-align: center;
            padding: 4rem 5% 2rem;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        /* ABOUT SECTION */
        .about-section {
            padding: 4rem 5% 6rem;
            background: var(--bg-secondary);
            text-align: center;
        }

        .about-section p {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 900px;
            margin: 0 auto;
        }

        /* VALUES SECTION */
        .values {
            padding: 6rem 5%;
            background: var(--bg-primary);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .value-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--red-pastel-1);
            transition: left 0.4s;
            z-index: 0;
        }

        .value-card:hover::before {
            left: 0;
        }

        .value-card:hover {
            border-color: var(--red-pastel-1);
            color: var(--text-light);
        }

        .value-card>* {
            position: relative;
            z-index: 1;
        }

        .value-number {
            font-size: 4rem;
            font-weight: bold;
            color: var(--red-pastel-1);
            line-height: 1;
            margin-bottom: 1rem;
            transition: color 0.4s;
        }

        .value-card:hover .value-number {
            color: var(--bg-secondary);
        }

        .value-card h3 {
            font-size: 1.6rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .value-card p {
            line-height: 1.7;
        }

        /* TEAM SECTION */
        .team-section {
            padding: 6rem 5%;
            background: var(--bg-secondary);
        }

        .team-grid {
            display: flex;
            gap: 2.5rem;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 1rem 0 2rem 0;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .team-card {
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
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 8px 8px 0 var(--red-pastel-1);
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--red-pastel-1);
        }

        .team-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--text);
            position: relative;
            padding-bottom: 0.8rem;
        }

        .team-name::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--red-pastel-1);
        }

        .team-id {
            font-size: 0.95rem;
            color: var(--red-pastel-1);
            font-weight: bold;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
        }

        /* CTA SECTION */
        .cta-section {
            padding: 6rem 5%;
            background: var(--red-pastel-1);
            text-align: center;
            color: var(--text-light);
        }

        .cta-section h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-button {
            display: inline-block;
            padding: 1.2rem 3rem;
            background-color: var(--bg-primary);
            color: var(--text);
            text-decoration: none;
            font-weight: bold;
            border: 2px solid var(--text);
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-button:hover {
            transform: translateY(-3px);
        }

        .cta-button.secondary {
            background-color: transparent;
            color: var(--text-light);
            border-color: var(--text-light);
        }

        .team-bio {
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--text);
            flex-grow: 1;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            main h1 {
                font-size: 2.5rem;
                padding: 3rem 5% 1.5rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .team-card {
                min-width: 280px;
                max-width: 280px;
                min-height: auto;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    @include('Frontend.components.nav')

    <main>

        <h1>About Us</h1>
        <div class="section-line"></div>

        <!-- About Section -->
        <section class="about-section">
            <p>
                LogIQ is designed as a fully functional e-commerce platform created for puzzle enthusiasts of all ages.
                Our goal is to provide a responsive and user-friendly space where customers can browse and filter
                products,
                submit queries, place orders, and track their previous purchases—all in one seamless experience.
            </p>
        </section>

        <div class="section-line"></div>

        <!-- Our Values -->
        <section class="values">
            <div class="section-header">
                <h2>Our Values</h2>
                <div class="divider"></div>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-number">01</div>
                    <h3>Curiosity</h3>
                    <p>We believe the best minds never stop asking "why." Our puzzles are designed to spark that innate
                        hunger for discovery and the unknown.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">02</div>
                    <h3>Quality</h3>
                    <p>From premium materials to precision-engineered mechanisms, we obsess over every detail. Our
                        puzzles are built to be heirlooms, not disposables.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">03</div>
                    <h3>Integrity</h3>
                    <p>We are honest about the challenge. We don't use gimmicks or "impossible" traps—every solution is
                        rooted in pure, consistent logic.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">04</div>
                    <h3>Perseverance</h3>
                    <p>Solvers aren't just customers; they are resilient thinkers. We celebrate the "grit" it takes to
                        fail a hundred times and try once more.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">05</div>
                    <h3>Innovation</h3>
                    <p>The world of logic is evolving. We constantly experiment with new materials and mechanical
                        concepts to keep the modern solver on their toes.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">06</div>
                    <h3>Sustainability</h3>
                    <p>We respect the planet as much as the mind. We prioritize eco-friendly sourcing and durable design
                        to minimize our environmental footprint.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">07</div>
                    <h3>Complexity</h3>
                    <p>We don't apologize for difficulty. We create multi-layered challenges that require deep, systemic
                        thinking to truly master.</p>
                </div>

                <div class="value-card">
                    <div class="value-number">08</div>
                    <h3>No Shortcuts</h3>
                    <p>There is no "easy mode" in growth. We provide the tools, but the victory belongs entirely to you.
                        You solve it, or you don't.</p>
                </div>
            </div>
        </section>

        <div class="section-line"></div>

        <!-- Our Team -->
        <section class="team-section">
            <div class="section-header">
                <h2>Our Team</h2>
                <div class="divider"></div>
            </div>

            <div class="team-grid">

                <div class="team-card">
                    <div class="team-name">Haaris Ibrahim</div>
                    <div class="team-id">ID: 240373645</div>
                    <div class="team-bio"></div>
                </div>

                <div class="team-card">
                    <div class="team-name">Cole Bailey</div>
                    <div class="team-id">ID: 230107571</div>
                    <div class="team-bio">Full-stack Developer & Likes Tirimisu</div>
                </div>

                <div class="team-card">
                    <div class="team-name">Benedict Okonkwo</div>
                    <div class="team-id">ID: 240367541</div>
                    <div class="team-bio"></div>
                </div>

                <div class="team-card">
                    <div class="team-name">Abderrahmane Laoubi</div>
                    <div class="team-id">ID: 230159972</div>
                    <div class="team-bio"></div>
                </div>

                <div class="team-card">
                    <div class="team-name">Jadhushaya Nithiyananthan</div>
                    <div class="team-id">ID: 240120980</div>
                    <div class="team-bio"></div>
                </div>

                <div class="team-card">
                    <div class="team-name">Iman Abbas El Ber</div>
                    <div class="team-id">ID: 240090339</div>
                    <div class="team-bio"></div>
                </div>

                <div class="team-card">
                    <div class="team-name">Ian Weng</div>
                    <div class="team-id">ID: 240171959</div>
                    <div class="team-bio"></div>
                </div>

                <div class="team-card">
                    <div class="team-name">Ibrahim Shah</div>
                    <div class="team-id">ID: 240278797</div>
                    <div class="team-bio"></div>
                </div>

            </div>
        </section>
        <div class="section-line"></div>

        <section class="cta-section">
            <h2>Ready To Test Your Limits?</h2>
            <p>Join thousands of solvers who refuse to think inside the box. Browse our collection and find your next
                obsession.</p>
            <div class="cta-buttons">
                <a href="{{ route('store.index') }}" class="cta-button">Explore Puzzles</a>
                <a href="#" class="cta-button secondary">Get In Touch</a>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    @include('Frontend.components.footer')

</body>

</html>
