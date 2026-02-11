<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Address - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <style>
        .page-header h2 {
            font-family: 'Inria Serif';
            font-size: 40px;
            color: rgba(49, 14, 14, 1);
            margin: 0 0 10px 0;
        }

        .add-address h3 {
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

        .add-address {
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
        .form-group select {
            padding: 10px;
            width: 500px;
            border: 1px solid rgba(115, 115, 115, 1);
            border-radius: 6px;
            font-size: 15px;
        }

        .address-button button {
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
    @include('Frontend.components.nav')

    <main>
        <div class="dashboard-layout">
            @include('Frontend.components.dashboard_sidebar')

            <div class="dashboard-content">

                <div class="page-header">
                    <h2>Your Address</h2>
                    <p class="page-subtitle">Add edit or remove an address</p>
                </div>

                <div class="add-address">
                    <h3>Add Address</h3>
                    <form method="POST">
                        <div class="form-group">
                            <label>Full Name:</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address:</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Phone Number:</label>
                            <input type="tel" name="number" required>
                        </div>

                        <div class="form-group">
                            <label>First Line Address:</label>
                            <input type="text" name="addressLine1" required>
                        </div>

                        <div class="form-group">
                            <label>Second Line Address:</label>
                            <input type="text" name="addressLine2">
                        </div>

                        <div class="form-group">
                            <label>Postcode:</label>
                            <input type="text" name="postcode" required>
                        </div>

                        <div class="form-group">
                            <label>Town/City</label>
                            <input type="text" name="townCity" required>
                        </div>

                        <div class="form-group">
                            <label>Country/Region</label>
                            <select name="Country/Region" required>
                                <option value="England">England</option>
                                <option value="Wales">Wales</option>
                                <option value="Scotland">Scotland</option>
                                <option value="Northen-ireland">Northern Ireland</option>
                            </select>
                        </div>

                        <div class="address-button">
                            <button type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('Frontend.components.footer')
</body>

</html
