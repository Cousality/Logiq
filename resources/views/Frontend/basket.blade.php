<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Basket - LOGIQ</title>
<link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
</head>

<body>

@include('Frontend.components.nav')

<header class="basket-header">
    <h1 class="basket-title">YOUR BASKET.</h1>

    @if (!empty($basketItems) && count($basketItems) > 0)
        <p class="basket-subtitle">
            {{ $basketItems->sum('quantity') }} item{{ $basketItems->sum('quantity') !== 1 ? 's' : '' }} ready for checkout
        </p>
    @else
        <p class="basket-subtitle">Your basket is empty</p>
    @endif
</header>

@if (!empty($basketItems) && count($basketItems) > 0)

<div class="basket-container">

<div class="basket-items">
@foreach ($basketItems as $item)

<div class="basket-item" data-id="{{ $item->orderItemID }}" data-price="{{ $item->product->productPrice }}">
@include('Frontend.components.basket_card', ['item' => $item])
</div>

@endforeach
</div>

<div class="order-summary">

<h2 class="summary-title">Order Summary</h2>

<div class="summary-row">
<span>Items</span>
<span id="subtotal">£{{ number_format($basketItems->sum(fn($item) => $item->product->productPrice * $item->quantity),2) }}</span>
</div>

<div id="discount-row" class="summary-row" style="display:none;">
<span>Discount</span>
<span id="discount-value">£0.00</span>
</div>

<div class="summary-row">
<span>Total</span>
<span id="grand-total">£{{ number_format($basketItems->sum(fn($item) => $item->product->productPrice * $item->quantity),2) }}</span>
</div>

<form action="{{ route('checkout.index') }}" method="GET">
<button type="submit" class="checkout-btn">Proceed to Checkout</button>
</form>

<a href="{{ route('store.index') }}" class="continue-shopping">
Continue Shopping
</a>

<div class="promo-section">
<strong>Have a promo code?</strong>

<div class="promo-input">
<input type="text" id="promo-code" placeholder="Enter code">
<button type="button" onclick="applyPromo()">Apply</button>
</div>

<p id="promo-message" style="margin-top:8px;color:red;"></p>

</div>

</div>

</div>

@else

<div class="empty-basket">
<h2>Your Basket is Empty.</h2>
<p>Time to add some brain-bending puzzles!</p>

<a href="{{ route('store.index') }}" class="cta-button">
Browse Store
</a>

</div>

@endif

@include('Frontend.components.footer')

<script>

let activePromo = null;

function changeQuantity(itemId, change)
{

const qtyDisplay = document.getElementById(`qty-${itemId}`);
let currentQty = parseInt(qtyDisplay.textContent);
let newQty = currentQty + change;

if(newQty < 1) newQty = 1;
if(newQty > 99) newQty = 99;

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

fetch(`/basket/${itemId}`,{
method:'PUT',
headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':token
},
body:JSON.stringify({quantity:newQty})
})
.then(res=>res.json())
.then(data=>{

if(data.success)
{

qtyDisplay.textContent=newQty;

const item=document.querySelector(`.basket-item[data-id="${itemId}"]`);
const price=parseFloat(item.dataset.price);

document.getElementById(`total-${itemId}`).textContent=
`£${(price*newQty).toFixed(2)}`;

updateSummary();

}

});

}

function updateSummary()
{

const items=document.querySelectorAll('.basket-item');

let subtotal=0;
let itemCount=0;

items.forEach(item=>{

const id=item.dataset.id;
const price=parseFloat(item.dataset.price);
const qty=parseInt(document.getElementById(`qty-${id}`).textContent);

subtotal+=price*qty;
itemCount+=qty;

});

let discount=0;

if(activePromo)
{

if(activePromo.type==='percentage')
discount=subtotal*(activePromo.value/100);

if(activePromo.type==='fixed')
discount=activePromo.value;

}

const total=subtotal-discount;

document.getElementById('subtotal').textContent=`£${subtotal.toFixed(2)}`;
document.getElementById('grand-total').textContent=`£${total.toFixed(2)}`;

if(discount>0)
{

document.getElementById('discount-row').style.display='flex';
document.getElementById('discount-value').textContent=`-£${discount.toFixed(2)}`;

}
else
{

document.getElementById('discount-row').style.display='none';

}

const subtitle=document.querySelector('.basket-subtitle');
if(subtitle)
subtitle.textContent=`${itemCount} item${itemCount!==1?'s':''} ready for checkout`;

}

function applyPromo()
{

const code=document.getElementById('promo-code').value.trim();
if(!code) return;

const token=document.querySelector('meta[name="csrf-token"]').getAttribute('content');

fetch('/basket/apply-promo',{
method:'POST',
headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':token
},
body:JSON.stringify({code:code})
})
.then(res=>res.json())
.then(data=>{

const message=document.getElementById('promo-message');

if(!data.success)
{

message.textContent=data.message;
activePromo=null;
updateSummary();
return;

}

message.style.color='green';
message.textContent=`Promo applied: ${data.code}`;

activePromo=data;

updateSummary();

})
.catch(err=>console.log(err));

}

</script>

</body>
</html>