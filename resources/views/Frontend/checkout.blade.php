<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    @include('Frontend.components.navbar')

    <div style="max-width: 800px; margin: 2rem auto; color: white;">
        <h1>Checkout</h1>
        <p>This is the checkout page.</p>
        <p><a href="{{ route('basket.index') }}" style="color: #fff; text-decoration: underline;">
            Back to Basket
        </a></p>
    </div>

    @include('Frontend.components.footer')
</body>
</html>
