<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - LOGIQ</title>

    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        .page-header h2 {
            font-family: 'Inria Serif';
            font-size: 40px;
            color: rgba(49, 14, 14, 1);
            margin: 0 0 10px 0;
        }

        .service-container h3 {
            font-family: 'Inria Serif';
            font-size: 25px;
            color: rgba(49, 14, 14, 1);
            margin: 0 0 10px 0;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .dashboard-content {
            flex: 1;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .service-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 10px;
            width: 500px;
            border: 1px solid rgba(115, 115, 115, 1);
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            height: 150px;
            resize: none;
        }

        .submit-btn button {
            width: 250px;
            padding: 12px;
            background: rgba(49, 14, 14, 1);
            color: rgba(255, 255, 255, 1);
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: rgba(49, 14, 14, 0.9);
        }
    </style>

</head>

<body>

    @include('Frontend.components.navbar')

    <main>
        <div class="dashboard-layout">

            @include('Frontend.components.dashboard_sidebar')

            <div class="dashboard-content">

                <div class="page-header">
                    <h2>Customer Service</h2>
                    <p class="page-subtitle">Submit a request or contact us for help</p>
                </div>

                <div class="service-container">
                    <h3>Contact Support</h3>

                    <form method="POST" action="{{ route('customer_service.add') }}">
                        @csrf

                        <div class="form-group">
                            <label>Order Number (Optional):</label>
                            <input type="text" name="orderNumber" value="{{ old('orderNumber') }}">
                        </div>

                        <div class="form-group">
                            <label>Issue Category:</label>
                            <select name="issueCategory" required>
                                <option value="">Select an option</option>
                                <option value="delivery" {{ old('issueCategory') == 'delivery' ? 'selected' : '' }}>
                                    Delivery Issue</option>
                                <option value="refund" {{ old('issueCategory') == 'refund' ? 'selected' : '' }}>Refund /
                                    Return</option>
                                <option value="account" {{ old('issueCategory') == 'account' ? 'selected' : '' }}>
                                    Account Issue</option>
                                <option value="payment" {{ old('issueCategory') == 'payment' ? 'selected' : '' }}>
                                    Payment Problem</option>
                                <option value="other" {{ old('issueCategory') == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Your Message:</label>
                            <textarea name="message" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="submit-btn">
                            <button type="submit">Submit Request</button>
                        </div>

                    </form>


                </div>

            </div>
        </div>
    </main>

    @include('Frontend.components.footer')

</body>

</html>
