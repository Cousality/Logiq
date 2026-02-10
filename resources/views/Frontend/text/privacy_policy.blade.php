<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
        .page-wrapper {
            padding: 4rem 5%;
            min-height: 80vh;
            display: flex;
            justify-content: center;
        }

        .policy-document {
            background: var(--white);
            border: 2px solid var(--text);
            box-shadow: 10px 10px 0px var(--red-pastel-1);
            max-width: 800px;
            width: 100%;
            padding: 3rem;
            position: relative;
        }

        .policy-header {
            border-bottom: 2px solid var(--text);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            text-align: center;
        }

        .policy-header h1 {
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
            color: var(--text);
        }

        .policy-header .meta {
            font-size: 0.9rem;
            color: var(--red-pastel-1);
            font-weight: bold;
            margin-top: 0.5rem;
            text-transform: uppercase;
        }

        .policy-section {
            margin-bottom: 2.5rem;
        }

        .policy-section h2 {
            font-size: 1.5rem;
            color: var(--text);
            background-color: var(--bg-secondary);
            display: inline-block;
            padding: 0.2rem 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--text);
            text-transform: uppercase;
        }

        .policy-section p {
            margin-bottom: 1rem;
            font-size: 1rem;
            text-align: justify;
        }


        .policy-section ul {
            list-style-type: none;
            padding-left: 1rem;
            border-left: 3px solid var(--red-pastel-1);
            background: var(--bg-primary);
            padding: 1rem 1rem 1rem 2rem;
        }

        .policy-section ul li {
            margin-bottom: 0.5rem;
            position: relative;
        }

        .policy-section ul li::before {
            content: ">";
            position: absolute;
            left: -1.5rem;
            color: var(--red-pastel-1);
            font-weight: bold;
        }

        a.links {
            color: var(--red-pastel-1);
            font-weight: bold;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: 0.2s;
        }

        a.links:hover {
            border-bottom: 1px solid var(--red-pastel-1);
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .page-wrapper {
                padding: 2rem 1rem;
            }

            .policy-document {
                padding: 1.5rem;
                box-shadow: 5px 5px 0px var(--red-pastel-1);
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
                <h1>Privacy Policy</h1>
                <div class="meta">Last Updated: 17/11/2025</div>
            </header>

            <div class="policy-section">
                <p>This Privacy Policy describes how your personal information is collected,
                    used, protected and shared when you visit or make a purchase from <strong>LogIQ</strong>
                    (the “website").</p>

                <p>Our goal is to provide our customers with a safe and secure shopping experience.
                    We aim to protect your personal data and handle it responsibly at every step.</p>
            </div>

            <div class="policy-section">
                <h2>01. Data Collection</h2>
                <p>We collect the information you provide when you create
                    an account, place an order, contact support, or interact
                    with our website. This includes:</p>

                <ul>
                    <li>Name & Identity</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Shipping coordinates</li>
                    <li>Payment credentials</li>
                    <li>Behavioral data (viewed pages/products)</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>02. Usage Parameters</h2>
                <p>We utilize your data points to:</p>

                <ul>
                    <li>Process transactions</li>
                    <li>Execute customer support</li>
                    <li>Optimize system performance</li>
                    <li>Personalise user experience</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>03. Security Protocols</h2>
                <p>We work to reduce risks through encryption, strict access controls, and regular
                    security reviews to ensure data integrity.</p>
            </div>

            <div class="policy-section">
                <h2>04. Third-Party Access</h2>
                <p>We only share your data when strictly necessary. This pertains to:</p>

                <ul>
                    <li>Payment processors</li>
                    <li>Logistics & Shipping providers</li>
                    <li>Authorized service partners</li>
                </ul>
                <p>Your information is handled securely and used only for the intended purpose.</p>
            </div>

            <div class="policy-section">
                <h2>05. User Rights</h2>
                <p>You have the right to access your information, correct inaccuracies, and request data deletion.</p>
                <p>If you have any questions or wish to report a privacy concern,
                    please <a class="links" href="customer_service">initiate contact</a>.</p>
            </div>

            <div class="policy-section">
                <p><em>*This policy is subject to modification. Updates will be reflected in the timestamp above.</em>
                </p>
            </div>

        </article>
    </main>

    @include('Frontend.components.footer')

</body>

</html>
