<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout - LOGIQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
        .checkout-wrapper {
            max-width: 1200px;
            margin: 30px auto 60px;
            padding: 0 20px 40px;
            display: flex;
            gap: 24px;
        }

        .checkout-main {
            flex: 2;
            background: #fff;
            border-radius: 16px;
            padding: 24px 24px 32px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .checkout-summary {
            flex: 1;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            align-self: flex-start;
        }

        .checkout-title {
            font-family: "Inria Serif";
            font-size: 32px;
            margin: 0 0 4px;
            color: #310E0E;
        }

        .checkout-subtitle {
            margin: 0 0 20px;
            color: #666;
            font-size: 14px;
        }

        .checkout-steps {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #999;
        }

        .step-pill {
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid #e0e0e0;
        }

        .step-pill.active {
            border-color: #310E0E;
            background: #310E0E;
            color: #fff;
        }

        .section {
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f2f2f2;
        }

        .section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #310E0E;
            margin: 0;
        }

        .section-note {
            font-size: 13px;
            color: #888;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px 16px;
        }

        .form-row-full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px 11px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: #310E0E;
            box-shadow: 0 0 0 1px rgba(49, 14, 14, 0.15);
        }

        .radio-group {
            display: flex;
            gap: 16px;
            margin-top: 4px;
            font-size: 14px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .terms-row {
            margin-top: 14px;
            font-size: 13px;
            color: #555;
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }

        .terms-row input {
            margin-top: 2px;
        }

        .primary-btn {
            width: 100%;
            border: none;
            border-radius: 999px;
            background: #310E0E;
            color: #fff;
            padding: 13px 18px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 18px;
            transition: background .15s ease, transform .05s ease;
        }

        .primary-btn:hover {
            background: #4A1F1F;
        }

        .primary-btn:active {
            transform: translateY(1px);
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 16px;
            color: #310E0E;
        }

        .summary-items {
            max-height: 260px;
            overflow-y: auto;
            margin-bottom: 16px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 12px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .summary-item-name {
            color: #333;
        }

        .summary-item-meta {
            font-size: 12px;
            color: #777;
        }

        .summary-totals {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .summary-row.total {
            margin-top: 6px;
            font-weight: 700;
            font-size: 15px;
            color: #310E0E;
        }

        .summary-note {
            font-size: 12px;
            color: #888;
            margin-top: 6px;
        }

        .back-link {
            display: inline-block;
            margin-top: 10px;
            font-size: 13px;
            color: #fff;
            text-decoration: underline;
        }

        .back-link:hover {
            color: #f3d7d7;
        }

        @media (max-width: 900px) {
            .checkout-wrapper {
                flex-direction: column;
            }

            .checkout-main,
            .checkout-summary {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <div class="checkout-wrapper">

        {{-- LEFT: MAIN FORM --}}
        <section class="checkout-main">
            <h1 class="checkout-title">Checkout</h1>
            <p class="checkout-subtitle">Review your details and confirm your order.</p>

            <div class="checkout-steps">
                <div class="step-pill">1. Basket</div>
                <div class="step-pill active">2. Details &amp; Payment</div>
                <div class="step-pill">3. Confirmation</div>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Delivery details</h2>
                        <span class="section-note">We only use this to deliver your puzzles.</span>
                    </div>

                    <div class="form-grid">
                        <div class="form-row-full">
                            <label for="full_name">Full name</label>
                            <input id="full_name" name="full_name" type="text"
                                value="{{ old('full_name', auth()->user()->name ?? '') }}" required>
                        </div>

                        <div class="form-row-full">
                            <label for="email">Email address</label>
                            <input id="email" name="email" type="email"
                                value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        </div>

                        <div class="form-row-full">
                            <label for="address_line1">Address line 1</label>
                            <input id="address_line1" name="address_line1" type="text"
                                value="{{ old('address_line1') }}" required>
                        </div>

                        <div class="form-row-full">
                            <label for="address_line2">Address line 2 (optional)</label>
                            <input id="address_line2" name="address_line2" type="text"
                                value="{{ old('address_line2') }}">
                        </div>

                        <div>
                            <label for="city">Town / City</label>
                            <input id="city" name="city" type="text" value="{{ old('city') }}" required>
                        </div>

                        <div>
                            <label for="postcode">Postcode</label>
                            <input id="postcode" name="postcode" type="text" value="{{ old('postcode') }}" required>
                        </div>

                        <div>
                            <label for="country">Country</label>
                            <select id="country" name="country" required>
                                <option value="">Select country</option>
                                <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom
                                </option>
                                <option value="IE" {{ old('country') == 'IE' ? 'selected' : '' }}>Ireland</option>
                                <option value="EU" {{ old('country') == 'EU' ? 'selected' : '' }}>Europe (EU)
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="phone">Phone number (optional)</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Payment</h2>
                        <span class="section-note">Dummy payment – no real money will be taken.</span>
                    </div>

                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="payment_method" value="card"
                                {{ old('payment_method', 'card') == 'card' ? 'checked' : '' }}>
                            <span>Card</span>
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="payment_method" value="paypal"
                                {{ old('payment_method') == 'paypal' ? 'checked' : '' }}>
                            <span>PayPal</span>
                        </label>
                    </div>

                    <div class="form-grid" style="margin-top: 14px;">
                        <div class="form-row-full">
                            <label for="card_name">Name on card</label>
                            <input id="card_name" name="card_name" type="text" value="{{ old('card_name') }}"
                                required>
                        </div>

                        <div class="form-row-full">
                            <label for="card_number">Card number</label>
                            <input id="card_number" name="card_number" type="text" maxlength="19"
                                placeholder="4242 4242 4242 4242" value="{{ old('card_number') }}" required>
                        </div>

                        <div>
                            <label for="expiry_month">Expiry month</label>
                            <input id="expiry_month" name="expiry_month" type="text" maxlength="2"
                                placeholder="MM" value="{{ old('expiry_month') }}" required>
                        </div>

                        <div>
                            <label for="expiry_year">Expiry year</label>
                            <input id="expiry_year" name="expiry_year" type="text" maxlength="2"
                                placeholder="YY" value="{{ old('expiry_year') }}" required>
                        </div>

                        <div>
                            <label for="cvv">CVV</label>
                            <input id="cvv" name="cvv" type="text" maxlength="4" placeholder="123"
                                value="{{ old('cvv') }}" required>
                        </div>

                        <div></div>
                    </div>

                    <p class="summary-note" style="margin-top:10px;">
                        Ahh money money money money money - Mr Krabs.
                    </p>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Review &amp; confirm</h2>
                    </div>

                    <div class="terms-row">
                        <input id="agree_terms" name="agree_terms" type="checkbox" value="1" required>
                        <label for="agree_terms">
                            I confirm that my details are correct and I agree to the
                            <a href="{{ route('terms') }}" target="_blank">Terms &amp; Conditions</a>.
                        </label>
                    </div>

                    <button type="submit" class="primary-btn">
                        Place order
                    </button>

                    <a href="{{ route('basket.index') }}" class="back-link">
                        &larr; Back to basket
                    </a>
                </div>
            </form>
        </section>

        {{-- RIGHT: ORDER SUMMARY --}}
        <aside class="checkout-summary">
            <h2 class="summary-title">Order summary</h2>

            <div class="summary-items">
                @forelse(($cartItems ?? []) as $item)
                    <div class="summary-item">
                        <div>
                            <div class="summary-item-name">
                                {{ $item->product->productName ?? 'Product' }}
                            </div>
                            <div class="summary-item-meta">
                                Qty: {{ $item->quantity ?? 1 }}
                            </div>
                        </div>
                        <div>
                            £{{ number_format($item->priceAtTime ?? ($item->product->productPrice ?? 0), 2) }}
                        </div>
                    </div>
                @empty
                    <p style="font-size: 13px; color:#777;">Your basket is empty :(.</p>
                @endforelse
            </div>

            @php
                $subtotal = $subtotal ?? 0;
                $shipping = $shipping ?? 0;
                $total = $total ?? $subtotal + $shipping;
            @endphp

            <div class="summary-totals">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>£{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>
                        @if ($shipping == 0)
                            Free
                        @else
                            £{{ number_format($shipping, 2) }}
                        @endif
                    </span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>£{{ number_format($total, 2) }}</span>
                </div>
            </div>

            <p class="summary-note">
                Orders are usually dispatched within 1–2 working days.
            </p>
        </aside>
    </div>

    @include('Frontend.components.footer')
</body>

</html>
