<style>
/* FOOTER */
      footer {
        background: linear-gradient(
          135deg,
          var(--red-pastel-1),
          var(--red-pastel-2)
        );
        padding: 4rem 5% 2rem 5%;
        margin-top: 4rem;
      }

      .footer-content {
        color: var(--text-light);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto 3rem auto;
      }

      .footer-column h4 {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid var(--text-light);
        padding-bottom: 0.5rem;
        display: inline-block;
      }

      .footer-column ul {
        list-style: none;
      }

      .footer-column ul li {
        margin-bottom: 0.5rem;
      }

      .footer-column a {
        color: var(--text-light);
        text-decoration: none;
        transition: transform 0.2s;
        display: inline-block;
      }

      .footer-column a:hover {
        transform: translateX(5px);
      }

      .footer-bottom {
        color: var(--text-light);
        border-top: 2px solid var(--text-light);
        padding-top: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
      }
    </style>
<footer>
      <div class="footer-content">
        <div class="footer-column">
          <h4>Account</h4>
          <ul>
            <li><a class="footerLinks" href="your_orders">Your Orders</a></li>
            <li><a class="footerLinks" href="your_address">Your Address</a></li>
            <li><a class="footerLinks" href="my_puzzles">My Puzzles</a></li>
            <li><a class="footerLinks" href="wishlist">Wishlist</a></li>
            <li><a class="footerLinks" href="basket">Basket</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Quick Links</h4>
          <ul>
            <li><a class="footerLinks" href="about_us">About Us</a></li>
            <li><a class="footerLinks" href="customer_service">Customer Service</a></li>
            <li><a class="footerLinks" href="FAQs">FAQs</a>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Policies</h4>
          <ul>
            <li><a class="footerLinks" href="privacy_policy">Privacy Policy</a></li>
            <li><a class="footerLinks" href="TermsConditions">Terms & Conditions</a></li>
            <li><a class="footerLinks" href="return_policy">Return Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2026 LOGIQ. All puzzles reserved.</p>
      </div>
    </footer>