<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
        /* Unified Policy Styling (Same as Privacy & Return Policy) */
        .page-wrapper {
            padding: 4rem 5%;
            min-height: 80vh;
            display: flex;
            justify-content: center;
        }

        .policy-document {
            background: var(--white, #ffffff);
            border: 2px solid var(--text, #000);
            box-shadow: 10px 10px 0px var(--red-pastel-1, #ffb3b3);
            max-width: 800px;
            width: 100%;
            padding: 3rem;
            position: relative;
        }

        .policy-header {
            border-bottom: 2px solid var(--text, #000);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            text-align: center;
        }

        .policy-header h1 {
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
            color: var(--text, #000);
            margin: 0;
        }

        .policy-header .meta {
            font-size: 0.9rem;
            color: var(--red-pastel-1, #ffb3b3);
            font-weight: bold;
            margin-top: 0.5rem;
            text-transform: uppercase;
        }

        .policy-section {
            margin-bottom: 2.5rem;
        }

        .policy-section h2 {
            font-size: 1.5rem;
            color: var(--text, #000);
            background-color: var(--bg-secondary, #f0f0f0);
            display: inline-block;
            padding: 0.2rem 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--text, #000);
            text-transform: uppercase;
        }

        .policy-section p {
            margin-bottom: 1rem;
            font-size: 1rem;
            text-align: justify;
            color: var(--text, #000);
        }

        .policy-section ul {
            list-style-type: none;
            padding-left: 1rem;
            border-left: 3px solid var(--red-pastel-1, #ffb3b3);
            background: var(--bg-primary, #fafafa);
            padding: 1rem 1rem 1rem 2rem;
        }

        .policy-section ul li {
            margin-bottom: 0.5rem;
            position: relative;
            color: var(--text, #000);
        }

        .policy-section ul li::before {
            content: ">";
            position: absolute;
            left: -1.5rem;
            color: var(--red-pastel-1, #ffb3b3);
            font-weight: bold;
        }

        a.links {
            color: var(--red-pastel-1, #ffb3b3);
            font-weight: bold;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: 0.2s;
        }

        a.links:hover {
            border-bottom: 1px solid var(--red-pastel-1, #ffb3b3);
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 2rem 1rem;
            }

            .policy-document {
                padding: 1.5rem;
                box-shadow: 5px 5px 0px var(--red-pastel-1, #ffb3b3);
            }

            .policy-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <main class="page-wrapper">
        <article class="policy-document">
            <header class="policy-header">
                <h1>Terms & Conditions</h1>
                <div class="meta">Last Updated: 19/11/2025</div>
            </header>

            <div class="policy-section">
                <p>Welcome to LogIQ. By accessing or using our website, services, or applications, you agree to be bound
                    by these Terms and Conditions. Please read them carefully before using our services.</p>
            </div>

            <div class="policy-section">
                <h2>Eligibility</h2>
                <p>You must be at least 13 years old to use our services. By using our platform, you confirm that you
                    meet these requirements.</p>
            </div>

            <div class="policy-section">
                <h2>Use of Services</h2>
                <ul>
                    <li>You agree to use our services only for lawful purposes.</li>
                    <li>You must not misuse our platform, including attempts to hack, disrupt, or exploit it.</li>
                    <li>We reserve the right to suspend or terminate accounts that violate these terms.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Intellectual Property</h2>
                <p>All content, trademarks, logos, and designs on our platform are owned by LogIQ, unless otherwise
                    stated. You may not copy, reproduce, or distribute our content without prior written consent.</p>
            </div>

            <div class="policy-section">
                <h2>Account Security</h2>
                <ul>
                    <li>You are responsible for maintaining the confidentiality of your login details.</li>
                    <li>You agree to provide accurate and up‑to‑date information.</li>
                    <li>We may suspend or terminate accounts that provide false information or misuse the service.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Payments & Subscriptions</h2>
                <ul>
                    <li>Fees, billing cycles, and refund policies are outlined at the time of purchase.</li>
                    <li>You are responsible for any applicable taxes or charges.</li>
                    <li>Subscriptions may be canceled according to our cancellation policy.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Limitation of Liability</h2>
                <p>To the fullest extent permitted by law, LogIQ is not liable for any damages, losses, or claims
                    arising from your use of our services.</p>
            </div>

            <div class="policy-section">
                <h2>Privacy & Third Parties</h2>
                <p>Your use of our services is also governed by our Privacy Policy, which explains how we collect, use,
                    and protect your personal data.</p>
                <p>Our platform may contain links to external websites. We are not responsible for the content,
                    policies, or practices of third‑party sites.</p>
            </div>

            <div class="policy-section">
                <h2>Termination & Law</h2>
                <p>We may suspend or terminate your access to our services at any time, without prior notice, if you
                    violate these terms.</p>
                <p>These Terms and Conditions are governed by the laws of England and Wales. Any disputes will be
                    subject to the exclusive jurisdiction of the courts in that region.</p>
            </div>

            <div class="policy-section">
                <h2>Changes to Terms</h2>
                <p>We may update these Terms and Conditions from time to time. The latest version will always be
                    available on our website. Continued use of our services after changes means you accept the updated
                    terms.</p>
            </div>

            <div class="policy-section">
                <h2>Contact Us</h2>
                <p>If you have any questions about these Terms & Conditions, please <a class="links"
                        href="customer_service">contact us</a>.</p>
            </div>

        </article>
    </main>

    @include('Frontend.components.footer')

</body>

</html>
