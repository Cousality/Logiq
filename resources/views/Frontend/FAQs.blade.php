<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - LOGIQ</title>

    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
            font-family: 'Inria Serif', serif;
            color: white;
        }

        h1 {
            font-size: 60px;
            text-align: center;
            margin-top: 40px;
        }

        .faq-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 40px;
        }

        .faq-item {
            background: white;
            color: #310E0E;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.25);
        }

        .faq-question {
            font-weight: bold;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
        }

        .faq-answer {
            margin-top: 10px;
            display: none;
            font-size: 18px;
        }

        /* Submit Question Form */
        .form-section {
            background: white;
            color: #310E0E;
            padding: 25px;
            border-radius: 12px;
            margin-top: 40px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.25);
        }

        .form-section h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-section input,
        .form-section textarea {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #bbb;
            font-family: 'Inria Serif', serif;
        }

        .form-section button {
            margin-top: 15px;
            width: 100%;
            padding: 12px;
            background: #310E0E;
            color: white;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .form-section button:hover {
            background: #4A1818;
        }
    </style>

    <script>
        function toggleFAQ(id) {
            const answer = document.getElementById(id);
            answer.style.display = answer.style.display === "block" ? "none" : "block";
        }
    </script>
</head>

<body>

    {{-- NAVBAR --}}
    @include('Frontend.components.navbar')

    <main>

        <h1>Frequently Asked Questions</h1>

        <div class="faq-container">

            {{-- FAQ ITEMS --}}
            @php
                $faqs = [
                    [
                        'q' => 'How do I place an order on LogIQ?',
                        'a' => 'Browse our puzzles, add items to your basket, and proceed to checkout where you enter delivery and payment details.'
                    ],
                    [
                        'q' => 'Do I need an account to make a purchase?',
                        'a' => 'No, you can checkout as a guest. An account allows order tracking and wishlist saving.'
                    ],
                    [
                        'q' => 'What payment methods do you accept?',
                        'a' => 'We offer secure payments through PayPal, Visa, Mastercard, Apple Pay, and Google Pay.'
                    ],
                    [
                        'q' => 'How long does delivery take?',
                        'a' => 'Most orders arrive within 3–5 working days, depending on your location.'
                    ],
                    [
                        'q' => 'Can I return or exchange an item?',
                        'a' => 'Yes — items can be returned within 14 days in unused condition.'
                    ],
                    [
                        'q' => 'What if an item arrives damaged?',
                        'a' => 'Contact us immediately and we will replace it at no extra cost.'
                    ],
                    [
                        'q' => 'Do you offer international shipping?',
                        'a' => 'Currently we ship within the UK only.'
                    ],
                    [
                        'q' => 'How can I contact customer support?',
                        'a' => 'Through the contact form or by emailing support.'
                    ],
                    [
                        'q' => 'Are your puzzles suitable for all ages?',
                        'a' => 'Yes — we offer beginner, intermediate, and advanced puzzles for all ages.'
                    ],
                    [
                        'q' => 'Do you restock sold-out puzzles?',
                        'a' => 'Yes — restocks occur regularly. Add items to your wishlist for notifications.'
                    ],
                ];
            @endphp

            @foreach($faqs as $i => $faq)
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ('faq{{ $i }}')">
                        {{ $faq['q'] }}
                        <span>+</span>
                    </div>
                    <div id="faq{{ $i }}" class="faq-answer">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach

            {{-- Submit Question Form --}}
            <div class="form-section">
                <h2>Still need help?</h2>
                <p>If your question wasn’t answered above, submit your own below.</p>

                <form onsubmit="alert('Your question has been received (demo).'); return false;">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>

                    <textarea rows="4" placeholder="Your Question" required></textarea>

                    <button type="submit">Submit Question</button>
                </form>
            </div>

        </div>

    </main>

    {{-- FOOTER --}}
    @include('Frontend.components.footer')

</body>
</html>
