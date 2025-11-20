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
            font-family: 'Inria Serif';
        }

        .faq-container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #310E0E;
            font-size: 40px;
            margin-bottom: 20px;
        }

        .faq-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            text-align: left;
            background: #f2f2f2;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .faq-answer {
            padding: 15px;
            display: none;
            background: white;
            border-top: 1px solid #ddd;
            font-size: 16px;
        }

        .submit-box {
            margin-top: 40px;
            padding: 20px;
            background: #f7f7f7;
            border-radius: 10px;
        }

        .submit-box input, .submit-box textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #bbb;
            font-size: 16px;
        }

        .submit-btn {
            margin-top: 15px;
            background: #310E0E;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            font-size: 16px;
        }

        .submit-btn:hover {
            background: #562323;
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

    <div class="faq-container">

        <h1>Frequently Asked Questions</h1>

        <!-- FAQ LIST -->
        <!-- Each FAQ item adapted to match the About Us structure -->

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq1')">How do I place an order on LogIQ?</button>
            <div class="faq-answer" id="faq1">
                You can browse our puzzles, add items to your basket, and proceed to checkout where you’ll enter delivery and payment details.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq2')">Do I need an account to make a purchase?</button>
            <div class="faq-answer" id="faq2">
                No — you can checkout as a guest. However, creating an account allows you to track past orders and save your wishlist.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq3')">What payment methods do you accept?</button>
            <div class="faq-answer" id="faq3">
                We support secure payments via PayPal, Visa, Mastercard, Apple Pay, and Google Pay.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq4')">How long does delivery take?</button>
            <div class="faq-answer" id="faq4">
                Delivery times vary by location, but most orders arrive within 3–5 working days.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq5')">Can I return or exchange an item?</button>
            <div class="faq-answer" id="faq5">
                Items can be returned within 14 days if they are unused and in original condition.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq6')">What if my item arrives damaged?</button>
            <div class="faq-answer" id="faq6">
                Contact us immediately and we will replace the item at no additional cost.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq7')">Do you offer international shipping?</button>
            <div class="faq-answer" id="faq7">
                Currently we ship within the UK only, but international options may be added later.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq8')">Are your puzzles suitable for all ages?</button>
            <div class="faq-answer" id="faq8">
                Yes — we stock puzzles for beginners, children, adults, and advanced puzzlers.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq9')">Do you restock sold-out puzzles?</button>
            <div class="faq-answer" id="faq9">
                Yes — popular items are regularly restocked. You can add them to your wishlist for alerts.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ('faq10')">What should I do if I'm stuck on a puzzle?</button>
            <div class="faq-answer" id="faq10">
                Some puzzles include hints or solution guides. If yours doesn’t, contact us and we may provide additional help.
            </div>
        </div>

        <!-- SUBMIT A QUESTION SECTION -->

        <div class="submit-box">
            <h2>Still need help?</h2>
            <p>Submit a question and our team will get back to you.</p>

            <form onsubmit="alert('Your question has been submitted!'); return false;">
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <textarea placeholder="Your Question" rows="4" required></textarea>
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>

    </div>

</body>
</html>
