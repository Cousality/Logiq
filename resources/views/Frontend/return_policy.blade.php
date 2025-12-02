<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Policy</title>
    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        #main-return-page {
            padding-left: 60px;
            padding-right: 60px;
        }

        .return-section {
            padding-left: 80px;
            padding-right: 80px;
            padding-bottom: 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            font-family: 'inria Serif';
            font-size: 60px;
            color: rgba(255, 255, 255, 100);
            text-align: center;
        }

        h2 {
            font-family: 'inria Serif';
            font-size: 30px;
            color: rgba(255, 255, 255, 100);
            font-style: italic;
            font-weight: bolder;
        }

        p {
            font-family: 'inria Serif';
            font-size: 20px;
            color: rgba(255, 255, 255, 100);
        }

        .lists {
            font-family: 'inria Serif';
            color: rgba(255, 255, 255, 100);
            font-size: 20px;
            list-style-type: disc;
        }

        .links {
            color: rgba(255, 255, 255, 100);
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <main>
        <section id="Return_policy">
            <h1>Return Policy</h1>

            <div class="return-section">
                <p>Thank you for choosing LogIQ. We are committed to providing high quality products and a smooth
                    customer experience. Please read our Return Policy carefully to understand how returns, exchanges,
                    and refunds are handled.</p>
            </div>

            <div class="return-section">
                <h2>Eligibility for Returns</h2>
                <p>We accept returns under the following conditions:</p>
                <ul class="lists">
                    <li>The return request is made within <strong>30 days</strong> of delivery.</li>
                    <li>Items must be <strong>unused, unopened, and in their original packaging</strong>.</li>
                    <li>The puzzle must not be opened or assembled.</li>
                    <li>All pieces, accessories, and packaging must be intact.</li>
                    <li>A valid proof of purchase is required.</li>
                </ul>
            </div>

            <div class="return-section">
                <h2>Non-Returnable Items</h2>
                <ul class="lists">
                    <li>Opened or partially assembled items</li>
                    <li>Puzzles with damaged or missing pieces</li>
                    <li>Clearance or final sale items</li>
                    <li>Items damaged due to misuse or mishandling</li>
                </ul>
            </div>

            <div class="return-section">
                <h2>Damaged or Defective Items</h2>
                <p>If your order arrives damaged, defective, or missing pieces, please notify us within <strong>7
                        days</strong> of delivery.</p>
                <p>We may request photos of the damage for verification. Once approved, you may receive:</p>
                <ul class="lists">
                    <li>A replacement of the same item (subject to availability)</li>
                    <li>A missing-piece resolution if applicable</li>
                    <li>A full refund if a replacement is not available</li>
                </ul>
            </div>

            <div class="return-section">
                <h2>Return Shipping</h2>
                <ul class="lists">
                    <li>Customers are responsible for return shipping costs.</li>
                    <li>Return shipping is covered by LogIQ only if the item arrived damaged, defective, or incorrect.
                    </li>
                    <li>Original shipping charges are non refundable.</li>
                </ul>
            </div>

            <div class="return-section">
                <h2>Refund Processing</h2>
                <p>Refunds are issued to the original payment method once the returned item has been received and
                    inspected.</p>
                <p>Please allow <strong>3 to 10 business days</strong> for the refund to be processed.</p>
            </div>

            <div class="return-section">
                <h2>Order Cancellations</h2>
                <p>Orders may be cancelled before they are shipped. Once an order has been dispatched, it will fall
                    under our standard return policy.</p>
            </div>


            <div class="return-section">
                <h2>Contact Us</h2>
                <p>If you have questions or wish to return, please <a class="links" href="customer_service">Customer
                        Service</a>.</p>
                <p>Last Updated: 19/11/2025</p>
            </div>

        </section>
    </main>

    @include('Frontend.components.footer')

</body>

</html>
