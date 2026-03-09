<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style>
        .confirmation-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            text-align: center;
            padding: 4rem 5%;
        }

        .confirmation-box {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 3rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 6px 6px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .confirmation-box:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0px var(--text);
        }

        .confirmation-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .confirmation-title {
            font-size: 2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 1rem;
        }

        .confirmation-message {
            font-size: 1rem;
            line-height: 1.7;
            opacity: 0.8;
            margin-bottom: 2rem;
        }

        .btn-home {
            display: inline-block;
            padding: 0.85rem 2rem;
            background: var(--text);
            color: var(--white);
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid var(--text);
            transition: 0.2s;
        }

        .btn-home:hover {
            background: var(--red-pastel-1);
            border-color: var(--red-pastel-1);
            transform: translateY(-2px);
        }
    </style>
</head>
@include('partials.ChatWidget')
<body>
    @include('Frontend.components.nav')

    <div class="confirmation-wrapper">
        <div class="confirmation-box">
            <div class="confirmation-icon">✅</div>
            <h1 class="confirmation-title">Request Submitted!</h1>
            <p class="confirmation-message">
                Your request has been submitted successfully.<br>
                One of our team members will contact you shortly.
            </p>
            <a href="{{ route('home') }}" class="btn-home">Back to Home</a>
        </div>
    </div>

    @include('Frontend.components.footer')
</body>

</html>