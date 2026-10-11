  <!-- Footer -->
  <footer class="footer">
    <div class="footer__inner">
      <div class="footer__about">
        <h2 class="footer__title">The #1 premium corporate gifts supplier in the Middle East.</h2>
        <ul class="footer__points">
          <li>Decades of Trusted Expertise in branded merchandise, corporate &amp; promotional giveaways</li>
          <li>Extensive collection of over 3,000 ready-stock products and counting…</li>
          <li>Diverse range of premium brands including Moleskine, Cross, Skross, Ocean Bottle, Stormtech, XDDesign, and a lot more!</li>
          <li>Custom items such as drinkware, notebooks, bags, and so much more! Serving clients across Middle East, Africa and India!</li>
        </ul>
        <ul class="social" aria-label="Social media">
          <li><a href="#" aria-label="Facebook"><svg class="icon"><use href="#i-facebook"/></svg></a></li>
          <li><a href="#" aria-label="Instagram"><svg class="icon"><use href="#i-instagram"/></svg></a></li>
          <li><a href="#" aria-label="X"><svg class="icon"><use href="#i-x"/></svg></a></li>
          <li><a href="#" aria-label="YouTube"><svg class="icon"><use href="#i-youtube"/></svg></a></li>
          <li><a href="#" aria-label="TikTok"><svg class="icon"><use href="#i-tiktok"/></svg></a></li>
        </ul>
        <img class="footer__accept" src="{{ asset('assets/images/accept.jpg') }}" alt="We accept Mastercard and Visa" width="188" height="30" loading="lazy">
      </div>

      <div class="footer__info">
        <div class="footer__columns">
          <nav aria-label="Company info">
            <h3 class="footer__heading">Company Info</h3>
            <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Sustainability</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Jobs</a></li>
            <li><a href="#">Contact Us</a></li>
            </ul>
          </nav>
          <nav aria-label="Products">
            <h3 class="footer__heading">Products</h3>
            <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">E-Catalog</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Brands</a></li>
            <li><a href="#">Branding Methods</a></li>
            </ul>
          </nav>
          <nav aria-label="Support">
            <h3 class="footer__heading">Support</h3>
            <ul>
            <li><a href="#">FAQS</a></li>
            <li><a href="#">APIs</a></li>
            <li><a href="#">Reseller Registration</a></li>
            <li><a href="#">Our Locations</a></li>
            <li><a href="#">Blogs</a></li>
            </ul>
          </nav>
        </div>

        <div class="footer__contact">
          <a class="footer__chip" href="mailto:info@jasani.ae"><svg class="icon"><use href="#i-mail"/></svg>Email</a>
          <a class="footer__chip" href="tel:+971557863450"><svg class="icon"><use href="#i-phone"/></svg>Call</a>
          <a class="footer__chip" href="https://wa.me/971557863450" target="_blank" rel="noopener"><svg class="icon"><use href="#i-whatsapp"/></svg>Whatsapp</a>
        </div>

        <div class="footer__offices">
          <h3 class="footer__offices-title">Our Offices:</h3>
          <a class="footer__office" href="#">Dubai</a>
          <a class="footer__office" href="#">Sharjah</a>
        </div>

        <form class="newsletter" data-newsletter novalidate>
          <label class="newsletter__label" for="newsletter-email">Stay updated - subscribe for the latest news and offers!</label>
          <div class="newsletter__row">
            <input class="newsletter__input" id="newsletter-email" type="email" placeholder="Your email..." required>
            <button class="newsletter__btn" type="submit">Subscribe</button>
          </div>
          <p class="newsletter__msg" data-newsletter-msg role="status"></p>
        </form>

        <p class="footer__note">For complaints or feedback about our services, please email our Managing Director at <a href="mailto:biren@jasani.ae">biren@jasani.ae</a> for immediate action.</p>
      </div>
    </div>
  </footer>

  <script src="{{ asset('assets/js/main.js') }}"></script>
