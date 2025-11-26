<!DOCTYPE html>
<style>
    #logiqFooter {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        background-color: rgba(49, 14, 14, 100);
        padding: 20px;
        margin: 0;
    }

    #footerColumns {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: flex-start;
        gap: 30px;
    }

    .list {
        display: flex;
        flex-direction: column;
        list-style-type: none;
        color: rgba(255, 255, 255, 100);
        font-size: 20px;
        padding-top: 30px;
        padding-bottom: 30px;
        margin: 0;
    }

    .footerLinks {
        text-decoration: none;
        color: rgba(255, 255, 255, 100);
    }

    .footerLinks:hover {
        text-decoration: underline;
    }

    #logoCopyright {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .footerLogo img {
        padding: 0px;
        width: 250px;
    }

    #footerCopyright {
        width: 50%;
        background-color: rgba(49, 14, 14, 100);
        color: white;
        font-size: 80%;
    }
</style>

<footer id="logiqFooter">
    <div id="footerColumns">

        <div>
            <ul class="list">
                <li>
                    <h4>Account</h4>
                </li>
                <li><a class="footerLinks" href="your_orders">Your Orders</a></li>
                <li><a class="footerLinks" href="your_address">Your Address</a></li>
                <li><a class="footerLinks" href="my_puzzles">My Puzzles</a></li>
                <li><a class="footerLinks" href="wishlist">Wishlist</a></li>
                <li><a class="footerLinks" href="basket">Basket</a></li>
            </ul>
        </div>

        <div>
            <ul class="list">
                <li>
                    <h4>Quick Links</h4>
                </li>
                <li><a class="footerLinks" href="about_us">About Us</a></li>
                <li><a class="footerLinks" href="customer_service">Customer Service</a></li>
                <li><a class="footerLinks" href="FAQs">FAQs</a>
                <li>
            </ul>
        </div>

        <div>
            <ul class="list">
                <li>
                    <h4>Policies</h4>
                </li>
                <li><a class="footerLinks" href="privacy_policy">Privacy Policy</a></li>
                <li><a class="footerLinks" href="TermsConditions">Terms & Conditions</a></li>
                <li><a class="footerLinks" href="return_policy">Return Policy</a></li>
            </ul>
        </div>

    </div>

    <section id="logoCopyright">
        <div id="footerCopyright">
            <p>&copy; LogIQ | All Rights Reserved | Secure payments via PayPal, Visa, MasteCard, Apple Pay, Google Pay
            </p>
        </div>

        <div class="footerLogo">
            <a href="/"><img src="{{ asset('Images/darker_logo.png') }}" alt="LOGIQ Logo"></a>
        </div>
    </section>

</footer>

</html>
