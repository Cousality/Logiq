<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Security</title>
    
    <style>
         body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        h1 {
            font-family: 'inria Serif';
            font-size: 40px;
            color: rgba(255, 255, 255, 100);
            text-align: center;
        }

        .address-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0px 0px 30px;
        }

        .address-container {
            background: rgb(255, 255, 255);
           display: flex;
            padding: 40px;
            border-radius: 15px;
            width: 400px;
            text-align: center;
    
        }

    </style>

</head>

<body>
    @include('Frontend.components.navbar')

    <main>
        <div>
            <h1>Login & Security</h1>
        </div>
        
        <div id="add_address">
            <h1 id="your_address">Your Address</h1>
            
            <div class="address-wrapper">
                <div class="address-container">
                    <form method="POST">
                        <div class="form-group">
                            <label>Country/Region</label>
                            <select name="Country/Region" required>
                                <option value="England">England</option>
                                <option value="Wales">Wales</option>
                                <option value="Scotland">Scotland</option>
                                <option value="Northen-ireland">Northern Ireland</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

    </main>

@include('Frontend.components.footer')
</body>

</html