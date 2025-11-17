<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <style>
        
         body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        #main-privacy-page {
            padding-left: 60px;
            padding-right: 60px;
        }

        .policy-section {
            padding-left: 80px;
            padding-right: 80px;
            padding-bottom: 20px;
        }

        h1 {
            font-family: 'inria Serif';
            font-size: 60px;
            color: rgba(255, 255, 255, 100);
            text-align: center;
        }

        h2 {
            font-family: 'inria Serif';
            font-size: 30px;
            color: rgba(255, 255, 255, 100);
            font-style: italic;
            font-weight: bolder;
            
        }

        .policy-section p {
            font-family: 'inria Serif';
            font-size: 20px;
            color: rgba(255, 255, 255, 100);
        }

        .lists {
            font-family: 'inria Serif';
            color: rgba(255, 255, 255, 100);
            font-size: 20px;
            list-style-type: disc;
        }

        .links {
            color: rgba(255, 255, 255, 100);        
        }

    </style>

</head>

<body>
    @include('Frontend.components.navbar')

<main>
    <section id="main-privacy-page">
        <h1>Privacy Policy</h1>
        
        <div class="policy-section">
            <p>This Privacy Policy describes how your personal information is collected,
                used, protected and shared when you visit or make a purchase from LogIQ 
                (the “website").</p>
                
            <p> Our goal is to provide our customers with a safe and secure shopping experience.
                We aim to protect your personal data and handle it responsibly at every step.</p>
        </div>
        
        <div class="policy-section">
            <h2>Information We Collect</h2>
            <p>We collect the information you provide when you create
                an account, place an order, contact support, or interact
                with our website. This may include your:</p>
            
            <ul class="lists">
                <li>name</li>
                <li>email address</li>
                <li>phone number</li>
                <li>shipping details</li>
                <li>payment information</li>
                <li>viewed pages and products</li>
            </ul>
        </div>
        
        <div class="policy-section">
            <h2>How We Use Your Information</h2>
            <p>We use your information to: </p>
            
            <ul class="lists">
                <li>process orders</li>
                <li>provide customer support</li>
                <li>improve our services</li>
                <li>personalise your experience</li>
            </ul>
        </div>
        
        <div class="policy-section">
            <h2>How We Protect Your Data</h2>
            <p>We work to reduce risks through encryption, access controls, and regular
                security reviews.</p>
        </div>
        
        <div class="policy-section">
            <h2>Sharing Your Information</h2>
            <p>We only share your data when it is necessary.This could be with:</p>
            
            <ul class="lists">
                <li>payment processors</li>
                <li>shipping providers</li>
                <li>service partners</li>
            </ul>
            
            <p>Your information is handled securely and used only for the intended purpose.</p>
        </div>
        
        <div class="policy-section">
            <h2>Your Rights</h2>
            <p>You have the right to access your information, correct inaccuracies and ask us to
                 delete your data.</p>
            <p>If you have any questions or wish to report a privacy concern,
                 please <a class="links" href="contact_us">contact us</a>.</p>
        </div>
        
        <div class="policy-section">
            <h2>Policy Updates</h2>
            <p>This policy can be changed at any time. The “Last Updated” date will be updated and added
                 to the site.</p>
            
             <p>Last Updated: 17/11/2025</p>
        </div>

    </section>
 </main>

 @include('Frontend.components.footer')

</body>

</html>