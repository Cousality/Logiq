<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout - LOGIQ</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="{{ asset('css/theme.css') }}">

<style>
.checkout-wrapper{
    max-width:1200px;
    margin:30px auto 60px;
    padding:0 20px 40px;
    display:flex;
    gap:24px;
}

.checkout-main{
    flex:2;
    background:#fff;
    border-radius:16px;
    padding:24px 24px 32px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.checkout-summary{
    flex:1;
    background:#fff;
    border-radius:16px;
    padding:24px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    position:sticky;
    top:20px;
}

.checkout-title{
    font-family:"Inria Serif";
    font-size:32px;
    color:#310E0E;
    margin-bottom:16px;
}

.section{
    margin-bottom:24px;
    padding-bottom:20px;
    border-bottom:1px solid #f2f2f2;
}

.section:last-of-type{border-bottom:none;}

.section-title{
    font-size:18px;
    font-weight:600;
    color:#310E0E;
    margin-bottom:12px;
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px 16px;
}

.form-row-full{grid-column:1/-1;}

label{
    font-size:13px;
    color:#444;
    margin-bottom:4px;
    display:block;
}

input,select{
    width:100%;
    padding:10px 11px;
    border-radius:8px;
    border:1px solid #ddd;
    font-size:14px;
}

input:focus,select:focus{
    border-color:#310E0E;
    box-shadow:0 0 0 1px rgba(49,14,14,.15);
    outline:none;
}

.paypal-btn{
    display:block;
    text-align:center;
    background:#ffc439;
    color:#111;
    border-radius:999px;
    padding:12px;
    text-decoration:none;
    font-weight:600;
    margin-bottom:14px;
}

.divider{
    text-align:center;
    font-size:11px;
    letter-spacing:.12em;
    color:#aaa;
    margin:12px 0;
}

.terms-row{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    margin-top:12px;
}

.terms-row input[type="checkbox"]{
    width:16px;
    height:16px;
    margin:0;
    cursor:pointer;
}

.primary-btn{
    width:100%;
    border-radius:999px;
    border:none;
    background:#310E0E;
    color:#fff;
    padding:13px;
    font-size:15px;
    cursor:pointer;
    margin-top:14px;
}

.summary-title{
    font-size:18px;
    font-weight:600;
    color:#310E0E;
    margin-bottom:14px;
}

.summary-item,.summary-row{
    display:flex;
    justify-content:space-between;
    font-size:14px;
    margin-bottom:6px;
}

.summary-row.total{
    font-weight:700;
    color:#310E0E;
}

@media(max-width:900px){
    .checkout-wrapper{flex-direction:column;}
    .checkout-summary{position:static;}
}
</style>
</head>

<body>

@include('Frontend.components.nav')

<div class="checkout-wrapper">

<!-- LEFT SIDE -->
<section class="checkout-main">

<h1 class="checkout-title">Checkout</h1>

<!-- PAYPAL BUTTON OUTSIDE FORM -->
<a href="{{ route('checkout.paypal') }}" class="paypal-btn">
    Continue with PayPal
</a>

<div class="divider">OR PAY WITH CARD</div>

<form action="{{ route('checkout.store') }}" method="POST">
@csrf

<!-- DELIVERY -->
<div class="section">
<h2 class="section-title">Delivery details</h2>

<div class="form-grid">
    <div class="form-row-full">
        <label>Full name</label>
        <input name="full_name" required>
    </div>

    <div class="form-row-full">
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <div class="form-row-full">
        <label>Address</label>
        <input name="address_line1" required>
    </div>

    <div>
        <label>City</label>
        <input name="city" required>
    </div>

    <div>
        <label>Postcode</label>
        <input name="postcode" required>
    </div>

    <div>
        <label>Country</label>
        <select name="country" required>
            <option value="">Select</option>
            <option>UK</option>
            <option>Ireland</option>
            <option>EU</option>
        </select>
    </div>

    <div>
        <label>Phone (optional)</label>
        <input type="tel" name="phone">
    </div>
</div>
</div>

<!-- PAYMENT -->
<div class="section">
<h2 class="section-title">Card payment</h2>

<div class="form-grid">
    <div class="form-row-full">
        <label>Name on card</label>
        <input type="text" name="card_name" autocomplete="cc-name">
    </div>

    <div class="form-row-full">
        <label>Card number</label>
        <input id="card_number" name="card_number" maxlength="19"
               placeholder="4242 4242 4242 4242" autocomplete="cc-number">
    </div>

    <div>
        <label>Expiry (MM/YY)</label>
        <input id="expiry" name="expiry" maxlength="5"
               placeholder="MM/YY" autocomplete="cc-exp">
    </div>

    <div>
        <label>CVV</label>
        <input id="cvv" name="cvv" maxlength="4"
               placeholder="123" autocomplete="cc-csc">
    </div>
</div>
</div>

<!-- CONFIRM -->
<div class="section">
<div class="terms-row">
    <input id="agree_terms" type="checkbox" required>
    <label for="agree_terms">
        I agree to the <a href="{{ route('terms') }}">Terms & Conditions</a>
    </label>
</div>

<button class="primary-btn">Place order</button>
</div>

</form>
</section>

<!-- RIGHT SIDE -->
<aside class="checkout-summary">
<h2 class="summary-title">Your Order</h2>

@foreach(($cartItems ?? []) as $item)
<div class="summary-item">
    <span>{{ $item->product->productName ?? 'Product' }} × {{ $item->quantity }}</span>
    <span>£{{ number_format($item->priceAtTime,2) }}</span>
</div>
@endforeach

<hr>

<div class="summary-row total">
    <span>Total</span>
    <span>£{{ number_format($total ?? 0,2) }}</span>
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