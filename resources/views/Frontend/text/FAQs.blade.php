<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />

    <style>
        main h1 {
            font-size: 3rem;
            text-align: center;
            padding: 4rem 5% 2rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--text);
        }

        .faq-page-wrapper {
            padding: 2rem 5% 5rem;
            display: flex;
            justify-content: center;
        }

        .faq-container {
            max-width: 900px;
            width: 100%;
        }

        .faq-divider {
            width: 100px;
            height: 4px;
            background: var(--red-pastel-1);
            margin: 0 auto 3rem;
        }

        .faq-item {
            background: var(--white);
            color: var(--text);
            border: 2px solid var(--text);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1rem;
            transition: border-color var(--transition);
        }

        .faq-item:hover {
            border-color: var(--red-pastel-1);
        }

        .faq-question {
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            gap: 1rem;
        }

        .faq-toggle {
            font-size: 1.4rem;
            color: var(--red-pastel-1);
            flex-shrink: 0;
            line-height: 1;
            transition: transform var(--transition);
            display: inline-block;
        }

        .faq-toggle.open {
            transform: rotate(45deg);
        }

        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.35s ease, margin-top 0.35s ease;
            margin-top: 0;
        }

        .faq-answer > div {
            overflow: hidden;
            font-size: 1rem;
            line-height: 1.7;
            border-left: 3px solid var(--red-pastel-1);
            padding-left: 1rem;
        }

        .faq-answer.open {
            grid-template-rows: 1fr;
            margin-top: 0.75rem;
        }

        /* Submit Question Form */
        .form-section {
            background: var(--white);
            color: var(--text);
            border: 2px solid var(--text);
            box-shadow: 0px 0px 0px var(--text);
            padding: 2rem 2.5rem;
            margin-top: 3rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-section:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .form-section h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-section p {
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .form-section button {
            margin-top: 1.25rem;
            width: 100%;
            padding: 0.85rem;
            background: var(--red-pastel-1);
            color: var(--text-light);
            font-size: 1rem;
            font-family: "Courier New", Courier, monospace;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 2px solid var(--red-pastel-1);
            cursor: pointer;
            transition: background var(--transition), border-color var(--transition), transform 0.2s;
        }

        .form-section button:hover {
            background: var(--red-pastel-2);
            border-color: var(--red-pastel-2);
            transform: translateY(-3px);
        }
    </style>

    <script>
        function toggleFAQ(id) {
            const answer = document.getElementById(id);
            const toggle = document.querySelector(`[data-faq="${id}"]`);
            answer.classList.toggle("open");
            toggle.classList.toggle("open");
        }
    </script>
</head>

<body>

    {{-- NAVBAR --}}
    @include('Frontend.components.nav')

    <main>

        <h1>Frequently Asked Questions</h1>

        <div class="faq-page-wrapper">
            <div class="faq-container">

                <div class="faq-divider"></div>

            {{-- FAQ ITEMS --}}
            @php
                $faqs = [
                    [
                        'q' => 'How do I place an order on LogIQ?',
                        'a' =>
                            'Browse our puzzles, add items to your basket, and proceed to checkout where you enter delivery and payment details.',
                    ],
                    [
                        'q' => 'Do I need an account to make a purchase?',
                        'a' => 'No, you can checkout as a guest. An account allows order tracking and wishlist saving.',
                    ],
                    [
                        'q' => 'What payment methods do you accept?',
                        'a' => 'We offer secure payments through PayPal, Visa, Mastercard, Apple Pay, and Google Pay.',
                    ],
                    [
                        'q' => 'How long does delivery take?',
                        'a' => 'Most orders arrive within 3–5 working days, depending on your location.',
                    ],
                    [
                        'q' => 'Can I return or exchange an item?',
                        'a' => 'Yes — items can be returned within 14 days in unused condition.',
                    ],
                    [
                        'q' => 'What if an item arrives damaged?',
                        'a' => 'Contact us immediately and we will replace it at no extra cost.',
                    ],
                    [
                        'q' => 'Do you offer international shipping?',
                        'a' => 'Currently we ship within the UK only.',
                    ],
                    [
                        'q' => 'How can I contact customer support?',
                        'a' => 'Through the contact form or by emailing support.',
                    ],
                    [
                        'q' => 'Are your puzzles suitable for all ages?',
                        'a' => 'Yes — we offer beginner, intermediate, and advanced puzzles for all ages.',
                    ],
                    [
                        'q' => 'Do you restock sold-out puzzles?',
                        'a' => 'Yes — restocks occur regularly. Add items to your wishlist for notifications.',
                    ],
                ];
            @endphp

            @foreach ($faqs as $i => $faq)
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ('faq{{ $i }}')">
                        {{ $faq['q'] }}
                        <span class="faq-toggle" data-faq="faq{{ $i }}">+</span>
                    </div>
                    <div id="faq{{ $i }}" class="faq-answer">
                        <div>{{ $faq['a'] }}</div>
                    </div>
                </div>
            @endforeach

            {{-- Submit Question Form --}}
            <div class="form-section">
                <h2>Still need help?</h2>
                <p>If your question wasn’t answered above, submit your own below.</p>

                <form onsubmit="alert('Your question has been received (demo).'); return false;">
                    <div class="form-group">
                        <input type="text" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea rows="4" placeholder="Your Question" required></textarea>
                    </div>

                    <button type="submit">Submit Question</button>
                </form>
            </div>

            </div>
        </div>

    </main>

    {{-- FOOTER --}}
    @include('Frontend.components.footer')

</body>

</html>
