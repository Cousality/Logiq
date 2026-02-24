<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />

    <style>
        .dashboard-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .dashboard-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        .dashboard-subtitle {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .back-nav {
            margin-top: 50px;
            margin-bottom: 25px;
            margin-left: 20%;
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            padding: 10px 15px;
            text-decoration: none;
            border: 2px solid var(--text);
            display: inline-block;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .dashboard-content {
            flex: 1;
        }

        .service-container {
            width: 60%;
            display: flex;
            flex-direction: column;
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            box-shadow: 10px 10px 0px var(--red-pastel-1);
            margin: 0 auto;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2.5rem;
            }

            .dashboard-header {
                background: var(--bg-primary);
            }
        }
    </style>

</head>

<body>

    @include('Frontend.components.nav')

    <main>
        <header class="dashboard-header">
            <h1 class="dashboard-title">Customer Service</h1>
            <p>Use the contact form to contact us.</p>
        </header>

        <div class="back-nav">
            <a href="{{ route('dashboard') }}" class="btn-secondary"> <- Back to Dashboard</a>
        </div>

        <div class="service-container">
            <h2 class="section-title">Contact Support</h2>
            
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
                <option value="other" {{ old('issueCategory') == 'other' ? 'selected' : '' }}>
                    Other</option>
            </select>
            </div>

            <div class="form-group">
                <label>Your Message:</label>
                <textarea name="message" required>{{ old('message') }}</textarea>
            </div>

            <div class="service-btn">
                <button type="submit" class="btn">Submit Request</button>
            </div>
            </form>
        </div>
    </main>

    @include('Frontend.components.footer')

</body>

</html>
