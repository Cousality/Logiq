<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
    <style>
        
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
        }

        #main-terms-page {
        padding-left: 60px;
        padding-right: 60px;
        }

        .terms-section {
        padding-left: 80px;
        padding-right: 80px;
        padding-bottom: 20px;
        max-width: 900px;
        margin: 0 auto;
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

        .terms-section p {
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
    <section id="Terms_conditions">
            <h1>Terms & Conditions</h1>
        
        <div class="terms-section">
            <p>Welcome to LogIQ.
            By accessing or using our website, services, or applications, you agree to be bound by these Terms and Conditions.
            Please read them carefully before using our services.</p>
                
           
        </div>
        
        <div class="terms-section">
            <h2>Eligibility</h2>
            <p>You must be at least 13 years old to use our services.
                By using our platform, you confirm that you meet these requirements.</p>
            
        </div>
        
        <div class="terms-section">
            <h2>Use of Services</h2>
            <ul class="lists">
                <li>You agree to use our services only for lawful purposes</li>
                <li>You must not misuse our platform, including attempts to hack, disrupt, or exploit it.</li>
                <li>We reserve the right to suspend or terminate accounts that violate these terms.</li>
                
            </ul>
        </div>
        
        <div class="terms-section">
           
            <p>All content, trademarks, logos, and designs on our platform are owned by LogIQ, unless otherwise stated.
                 You may not copy, reproduce, or distribute our content without prior written consent.</p>

            <ul class="lists">
                <li>You are responsible for maintaining the confidentiality of your login details.</li>
                <li>You agree to provide accurate and up‑to‑date information.</li>
                <li>We may suspend or terminate accounts that provide false information or misuse the service.</li>
                
            </ul>
        </div>
        
        <div class="terms-section">
            <h2>Payments & Subscriptions</h2>
        
            
            <ul class="lists">
                <li>Fees, billing cycles, and refund policies are outlined at the time of purchase.</li>
                <li>You are responsible for any applicable taxes or charges.</li>
                <li>Subscriptions may be canceled according to our cancellation policy.</li>
            </ul>
           <p>To the fullest extent permitted by law, LogIQ is not liable for any damages, losses, or claims arising from your use of our services.</p>
           <p>Your use of our services is also governed by our Privacy Policy, which explains how we collect, use, and protect your personal data.</p>
           <p>Our platform may contain links to external websites. We are not responsible for the content, policies, or practices of third‑party sites.</p>
           <p>We may suspend or terminate your access to our services at any time, without prior notice, if you violate these terms.</p>
           <p>These Terms and Conditions are governed by the laws of [Insert Jurisdiction, e.g., England and Wales]. 
            Any disputes will be subject to the exclusive jurisdiction of the courts in that region.</p>
        </div> 
        
        <div class="terms-section">
            <h2>Changes to Terms</h2>
            <p>We may update these Terms and Conditions from time to time. The latest version will always be available on our website.
                Continued use of our services after changes means you accept the updated terms.
            </p>
           
        </div>
        
        <div class="terms-section">
            <h2>Contact Us</h2>
            <p>If you have any questions about Terms & Conditions, please <a class="links" href="customer_service">contact us</a>.</p>
            
             <p>Last Updated: 19/11/2025</p>
        </div>

    </section>
 </main>

 @include('Frontend.components.footer')

</body>

</html>