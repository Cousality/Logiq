<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout - LOGIQ</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<style>

.checkout-header {
    padding: 4rem 5%;
    background: linear-gradient(135deg,
        var(--bg-primary) 60%,
        var(--red-pastel-static) 60%);
    border-bottom: 2px solid var(--text);
}

.header-title {
    font-size: 4rem;
    letter-spacing: -3px;
    margin-bottom: 1rem;
}

.checkout-wrapper{
    max-width:1200px;
    margin:30px auto 60px;
    padding:0 20px 40px;
    display:flex;
    gap:24px;
}

.checkout-main{
    flex: 2;
    padding: 3rem 5%;
    background: var(--white);
    border: 2px solid var(--text);
}

.checkout-summary{
    background: var(--bg-secondary);
    border: 2px solid var(--text);
    padding: 2rem;
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.checkout-title{
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    border-bottom: 2px solid var(--text);
    padding-bottom: 0.5rem;
}

.section {
    margin-bottom:24px;
    padding-bottom:15px;
    border-bottom:1px solid var(--text);
}

form .section:last-of-type {
    border-bottom:none;
}

.section-title{
    font-size:18px;
    font-weight:600;
    color: var(--text);
    margin-bottom:12px;
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px 16px;
}

.paypal-btn{
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 1rem;
    padding: 1rem;
    background: transparent;
    border: 1px solid var(--text);
    color: var(--text);
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 0.9rem;
    transition: all 0.2s;
    letter-spacing: 1px;
}

.paypal-btn:hover {
    background: var(--text);
    color: var(--bg-primary);
}

.divider{
    text-align:center;
    font-size:11px;
    letter-spacing:.12em;
    color: var(--text);
    margin:12px 0;
}

.terms-row{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    text-transform: uppercase;
    margin-top:12px;
}

.terms-row input[type="checkbox"]{
    width:16px;
    height:16px;
    margin:0;
    cursor:pointer;
}

.primary-btn {
    width: 100%;
    padding: 1.2rem;
    margin-top: 20px;
    background: var(--text);
    color: var(--white);
    border: none;
    font-family: inherit;
    font-weight: bold;
    font-size: 1.1rem;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 1px;
}

.primary-btn:hover {
    background: var(--red-pastel-1);
    transform: translateY(-2px);
}

.summary-title{
    font-size: 1.8rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: -1px;
}

.summary-item {
    display:flex;
    justify-content:space-between;
    font-size:14px;
    margin-bottom:0.6rem;
}

.price {
    padding-left: 6px;
}

.summary-row {
    display:flex;
    justify-content:space-between;
    font-size:14px;
    margin-top: 0.2rem;
    font-weight: bold;
}

.summary-row:first-of-type {
    display: flex;
    justify-content: space-between;
    border-top: 1px solid var(--text);
    margin-top: 1rem;
    padding-top:10px;
}

.summary-row.total {
    font-weight: bold;
    font-size: 1.2rem;     
}


@media(max-width:900px){
    .checkout-wrapper{flex-direction:column;}
    .checkout-summary{position:static;}
}
</style>
</head>

<body>

@include('Frontend.components.nav')

<header class="checkout-header">
    <h1 class="header-title">CHECKOUT.</h1>   
</header>

<div class="checkout-wrapper">

<!-- LEFT SIDE -->
<section class="checkout-main">

<div class="section">
    <h3 class="section-title">Payment Method</h3>
    
    <!-- PAYPAL BUTTON -->
     <a href="{{ route('checkout.paypal') }}" class="paypal-btn">Continue with PayPal</a>
     <div class="divider">OR PAY WITH CARD</div>
</div>

<form action="{{ route('checkout.store') }}" method="POST">
@csrf

<input type="hidden" name="payment_method" value="card">

<!-- DELIVERY -->
<div class="section">
<h3 class="section-title">Delivery Details</h3>

    <div class="form-group">
        <label>Full name</label>
        <input name="full_name" 
        value="{{ old('full_name', trim((auth()->user()->firstName ?? '').' '.(auth()->user()->lastName ?? ''))) }}" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Address Line 1</label>
        <input name="address_line1" required>
    </div>

    <div class="form-group">
        <label>Address Line 2 (Optional)</label>
        <input name="address_line2">
    </div>

    <div class="form-grid">
    <div class="form-group">
        <label>City</label>
        <input name="city" required>
    </div>

    <div class="form-group">
        <label>Postcode</label>
        <input name="postcode" required>
    </div>

    <div class="form-group">
        <label>Country</label>
        <select name="country" required>
            <option value="">Select Country</option>
            <option>UK</option>
            <option>Ireland</option>
            <option>Europe</option>
        </select>
    </div>

    <div class="form-group">
        <label>Phone (optional)</label>
        <input type="tel" name="phone">
    </div>
</div>
</div>

<!-- PAYMENT -->
<div class="section">
<h3 class="section-title">Card Details</h3>

    <div class="form-group">
        <label>Name on card</label>
        <input type="text" name="card_name" autocomplete="cc-name" required>
    </div>

    <div class="form-group">
        <label>Card number</label>
        <input id="card_number" name="card_number" maxlength="19"
               placeholder="4242 4242 4242 4242" autocomplete="cc-number" required>
    </div>

    <div class="form-grid">
    <div class="form-group">
        <label>Expiry (MM/YY)</label>
        <input id="expiry" name="expiry" maxlength="5"
               placeholder="MM/YY" autocomplete="cc-exp" required>
    </div>

    <div class="form-group">
        <label>CVV</label>
        <input id="cvv" name="cvv" maxlength="4"
               placeholder="123" autocomplete="cc-csc" required>
    </div>
</div>
</div>

<!-- CONFIRM -->
<div class="section">
<h3 class="section-title">Review and Confirm</h3>

<div class="terms-row">
    <input id="agree_terms" name="agree_terms" type="checkbox" required>
    <label for="agree_terms">
        I agree to the <a href="{{ route('terms') }}">Terms & Conditions</a>
    </label>
</div>

<button type="submit" class="primary-btn">Place order</button>
</div>

</form>
</section>

<!-- RIGHT SIDE -->
<aside class="checkout-summary">
<h2 class="summary-title">Your Order</h2>

@foreach(($cartItems ?? []) as $item)
<div class="summary-item">
    <span>{{ $item->product->productName ?? 'Product' }} × {{ $item->quantity }}</span>
    <span class="price">£{{ number_format($item->priceAtTime * $item->quantity, 2) }}</span>
</div>
@endforeach

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
        <span>£{{ number_format($total ?? 0,2) }}</span>
    </div>
</div>
</aside>

</div>

@include('Frontend.components.footer')

<script>
const card = document.getElementById('card_number');
const expiry = document.getElementById('expiry');
const cvv = document.getElementById('cvv');

/* CARD NUMBER */
card.addEventListener('input',()=>{
    let v = card.value.replace(/\D/g,'').substring(0,16);
    card.value = v.replace(/(.{4})/g,'$1 ').trim();
});

/* EXPIRY */
expiry.addEventListener('input',()=>{
    let v = expiry.value.replace(/\D/g,'').substring(0,4);
    if(v.length > 2) expiry.value = v.slice(0,2)+'/'+v.slice(2);
    else expiry.value = v;
});

/* CVV */
cvv.addEventListener('input',()=>{
    cvv.value = cvv.value.replace(/\D/g,'').substring(0,4);
});
</script>

</body>
</html>