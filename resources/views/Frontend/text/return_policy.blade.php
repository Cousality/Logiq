<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Policy - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
        /* COPIED FROM PRIVACY POLICY
           Ideally, move this to your theme.css so you don't repeat it in every file.
        */
        .page-wrapper {
            padding: 4rem 5%;
            min-height: 80vh;
            display: flex;
            justify-content: center;
        }

        .policy-document {
            background: var(--white, #ffffff);
            /* Fallback to white if var missing */
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

        /* Mobile Adjustments */
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
                <h1>Return Policy</h1>
                <div class="meta">Last Updated: 19/11/2025</div>
            </header>

            <div class="policy-section">
                <p>Thank you for choosing LogIQ. We are committed to providing high-quality products and a smooth
                    customer experience. Please read our Return Policy carefully to understand how returns, exchanges,
                    and refunds are handled.</p>
            </div>

            <div class="policy-section">
                <h2>Eligibility for Returns</h2>
                <p>We accept returns under the following conditions:</p>
                <ul>
                    <li>The return request is made within <strong>30 days</strong> of delivery.</li>
                    <li>Items must be <strong>unused, unopened, and in their original packaging</strong>.</li>
                    <li>The puzzle must not be opened or assembled.</li>
                    <li>All pieces, accessories, and packaging must be intact.</li>
                    <li>A valid proof of purchase is required.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Non-Returnable Items</h2>
                <ul>
                    <li>Opened or partially assembled items</li>
                    <li>Puzzles with damaged or missing pieces</li>
                    <li>Clearance or final sale items</li>
                    <li>Items damaged due to misuse or mishandling</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Damaged or Defective Items</h2>
                <p>If your order arrives damaged, defective, or missing pieces, please notify us within <strong>7
                        days</strong> of delivery.</p>
                <p>We may request photos of the damage for verification. Once approved, you may receive:</p>
                <ul>
                    <li>A replacement of the same item (subject to availability)</li>
                    <li>A missing-piece resolution if applicable</li>
                    <li>A full refund if a replacement is not available</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Return Shipping</h2>
                <ul>
                    <li>Customers are responsible for return shipping costs.</li>
                    <li>Return shipping is covered by LogIQ only if the item arrived damaged, defective, or incorrect.
                    </li>
                    <li>Original shipping charges are non-refundable.</li>
                </ul>
            </div>

            <div class="policy-section">
                <h2>Refund Processing</h2>
                <p>Refunds are issued to the original payment method once the returned item has been received and
                    inspected.</p>
                <p>Please allow <strong>3 to 10 business days</strong> for the refund to be processed.</p>
            </div>

            <div class="policy-section">
                <h2>Order Cancellations</h2>
                <p>Orders may be cancelled before they are shipped. Once an order has been dispatched, it will fall
                    under our standard return policy.</p>
            </div>

            <div class="policy-section">
                <h2>Contact Us</h2>
                <p>If you have questions or wish to return an item, please contact <a class="links"
                        href="customer_service">customer service</a>.</p>
            </div>

        </article>
    </main>

    @include('Frontend.components.footer')

</body>

</html>
