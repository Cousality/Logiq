<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #4A1F1F;
        }

        .product-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            flex-direction: row;
            align-items: flex-start;
        }

        .product-image-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
        }

        .product-image {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            aspect-ratio: 1;
            background-color: #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 18px;
        }

        .product-info-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            flex: 1;
        }

        .product-details-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-title {
            font-size: 32px;
            font-weight: bold;
            color: #310E0E;
            margin: 0;
        }

        .product-price {
            font-size: 28px;
            color: #4A1F1F;
            font-weight: 600;
        }

        .product-description {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-add-to-cart {
            flex: 1;
            padding: 15px 30px;
            background-color: #310E0E;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-add-to-cart:hover {
            background-color: #4A1F1F;
        }

        .btn-wishlist {
            padding: 15px 30px;
            background-color: transparent;
            color: #310E0E;
            border: 2px solid #310E0E;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-wishlist:hover {
            background-color: #310E0E;
            color: white;
        }

        .product-info {
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            color: #333;
        }
    </style>
</head>

<body>
    @include('Frontend.components.navbar')

    <div class="product-container">
        <div class="product-image-container">
            <div class="product-image">
                Product Image
            </div>
        </div>

        <div class="product-info-container">
            <div class="product-details-section">
                <h1 class="product-title">PlaceHolder Product Title</h1>

                <div class="product-price">£ Place holder</div>

                <div class="product-description">
                    <p>Placeholdder product description</p>
                </div>

                <div class="product-actions">
                    <button class="btn-add-to-cart">Add to Cart</button>
                    <button class="btn-wishlist">Wishlist</button>
                </div>

                <div class="product-info">
                    <div class="info-row">
                        <span class="info-label">ID:</span>
                        <span class="info-value">Placeholder</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Availability:</span>
                        <span class="info-value">Placeholder</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Category:</span>
                        <span class="info-value">Placeholder</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Frontend.components.footer')
</body>

</html>
