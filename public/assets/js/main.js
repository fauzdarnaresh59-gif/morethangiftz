/* ==========================================================================
   More Than Giftz — main script
   Modules: mobile navigation, carousels, cart, newsletter form, search
   ========================================================================== */
(() => {
  'use strict';

  const $ = (selector, scope = document) => scope.querySelector(selector);
  const $$ = (selector, scope = document) => [...scope.querySelectorAll(selector)];

  /* Cart System ------------------------------------------------------------- */
  const cart = {
    items: [],

    init() {
      const savedCart = localStorage.getItem('shoppingCart');
      if (savedCart) {
        this.items = JSON.parse(savedCart);
      }
      this.updateCounter();
    },

    save() {
      localStorage.setItem('shoppingCart', JSON.stringify(this.items));
      this.updateCounter();
    },

    add(product) {
      const existingItem = this.items.find(item => item.id === product.id);

      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        this.items.push({
          ...product,
          quantity: 1
        });
      }

      this.save();
      this.showNotification(`${product.title} added to cart!`);
    },

    remove(productId) {
      this.items = this.items.filter(item => item.id !== productId);
      this.save();
      this.render();
      attachCartEventListeners();
    },

    updateQuantity(productId, quantity) {
      const item = this.items.find(item => item.id === productId);
      if (item) {
        item.quantity = Math.max(1, quantity);
        this.save();
        this.render();
        attachCartEventListeners();
      }
    },

    getTotal() {
      return this.items.length; // Count unique products
    },

    updateCounter() {
      const counter = $('[data-cart-count]');
      if (counter) {
        const total = this.getTotal();
        counter.textContent = total;
        counter.hidden = total === 0;
      }
    },

    showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'cart-notification';
      notification.textContent = message;
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.classList.add('show');
      }, 10);

      setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
      }, 2000);
    },

    render() {
      const cartDropdown = $('#cart-dropdown');
      if (!cartDropdown) return;

      if (this.items.length === 0) {
        cartDropdown.innerHTML = `
          <div class="cart-header">
            <h3 class="cart-header-title">Shopping Cart</h3>
            <button class="cart-close" id="cart-close">×</button>
          </div>
          <div class="cart-empty">Your cart is empty</div>
        `;
      } else {
        const totalItems = this.getTotal();
        cartDropdown.innerHTML = `
          <div class="cart-header">
            <h3 class="cart-header-title">Shopping Cart (${totalItems} items)</h3>
            <button class="cart-close" id="cart-close">×</button>
          </div>
          <div class="cart-items">
            ${this.items.map(item => `
              <div class="cart-item" data-id="${item.id}">
                <img src="${item.image.startsWith('/') ? item.image : '/' + item.image}" alt="${item.title}" class="cart-item-image" onerror="this.src='/assets/images/placeholder.jpg'">
                <div class="cart-item-info">
                  <div class="cart-item-title">${item.title}</div>
                  <div class="cart-item-price">${item.price}</div>
                  <div class="cart-item-quantity">
                    <button class="qty-btn qty-minus" data-id="${item.id}">-</button>
                    <span class="qty-value">${item.quantity}</span>
                    <button class="qty-btn qty-plus" data-id="${item.id}">+</button>
                  </div>
                </div>
                <button class="cart-item-remove" data-id="${item.id}">×</button>
              </div>
            `).join('')}
          </div>
          <div class="cart-footer">
            <button class="cart-checkout-btn">Proceed to Checkout</button>
          </div>
        `;
      }

      // Add close button event listener
      const closeBtn = cartDropdown.querySelector('#cart-close');
      if (closeBtn) {
        closeBtn.addEventListener('click', () => {
          cartDropdown.style.display = 'none';
        });
      }
    }
  };

  /* Mobile navigation ------------------------------------------------------ */
  function initNavToggle() {
    const toggle = $('[data-nav-toggle]');
    const nav = $('[data-nav]');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', () => {
      const isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(isOpen));
    });
  }

  /* Carousels (dots <-> scrollable track) ---------------------------------- */
  function initCarousel(carousel) {
    const track = $('.carousel__track', carousel);
    const dots = $$('[data-dot]', carousel);
    if (!track || !dots.length) return;

    const maxScroll = () => track.scrollWidth - track.clientWidth;

    const setActive = (index) => {
      dots.forEach((dot, i) => dot.classList.toggle('is-active', i === index));
    };

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        setActive(index);
        if (maxScroll() <= 0) return;
        track.scrollTo({
          left: (maxScroll() / (dots.length - 1)) * index,
          behavior: 'smooth',
        });
      });
    });

    track.addEventListener('scroll', () => {
      if (maxScroll() <= 0) return;
      const progress = track.scrollLeft / maxScroll();
      setActive(Math.round(progress * (dots.length - 1)));
    }, { passive: true });
  }

  /* Cart counter ----------------------------------------------------------- */
  function initCart() {
    cart.init();

    document.addEventListener('click', (event) => {
      const addToCartBtn = event.target.closest('[data-add-to-cart]');
      if (!addToCartBtn) return;

      const card = addToCartBtn.closest('.featured-card, .product-card');
      if (!card) return;

      const productId = card.dataset.productId || Date.now().toString();
      const productType = card.dataset.productType || 'product';
      const title = card.querySelector('.featured-card__title, .product-card__title')?.textContent || 'Product';
      const price = card.querySelector('.price')?.textContent || '0.00 AED';
      const image = card.querySelector('img')?.src || '';
      const description = card.querySelector('.featured-card__desc, .product-card__code')?.textContent || '';

      // Clean image path - remove origin and ensure it starts with /
      let cleanImage = image.replace(window.location.origin, '');
      if (!cleanImage.startsWith('/')) {
        cleanImage = '/' + cleanImage;
      }

      const product = {
        id: `${productType}-${productId}`,
        title: title,
        price: price,
        image: cleanImage,
        description: description
      };

      cart.add(product);
    });

    // Cart dropdown toggle
    const cartButton = $('#cart-toggle');
    if (cartButton) {
      cartButton.addEventListener('click', (event) => {
        event.preventDefault();
        const cartDropdown = $('#cart-dropdown');
        if (cartDropdown) {
          const isVisible = cartDropdown.style.display === 'block';
          cartDropdown.style.display = isVisible ? 'none' : 'block';
          if (!isVisible) {
            cart.render();
            attachCartEventListeners();
          }
        }
      });
    }

    // Close cart dropdown when clicking outside
    document.addEventListener('click', (event) => {
      const cartDropdown = $('#cart-dropdown');
      const cartButton = $('#cart-toggle');
      if (cartDropdown && !cartDropdown.contains(event.target) && !cartButton?.contains(event.target)) {
        cartDropdown.style.display = 'none';
      }
    });

    // Close cart on escape key
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        const cartDropdown = $('#cart-dropdown');
        if (cartDropdown) {
          cartDropdown.style.display = 'none';
        }
      }
    });
  }

  /* Account dropdown -------------------------------------------------------- */
  function initAccountDropdown() {
    const accountToggle = $('#account-toggle');
    const accountDropdown = $('#account-dropdown');

    if (!accountToggle || !accountDropdown) return;

    accountToggle.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();

      const isExpanded = accountToggle.getAttribute('aria-expanded') === 'true';
      accountToggle.setAttribute('aria-expanded', String(!isExpanded));
      accountDropdown.classList.toggle('show');

      // Close cart dropdown if open
      const cartDropdown = $('#cart-dropdown');
      if (cartDropdown) {
        cartDropdown.style.display = 'none';
      }
    });

    // Close account dropdown when clicking outside
    document.addEventListener('click', (event) => {
      if (!accountToggle.contains(event.target) && !accountDropdown.contains(event.target)) {
        accountDropdown.classList.remove('show');
        accountToggle.setAttribute('aria-expanded', 'false');
      }
    });

    // Close account dropdown on escape key
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        accountDropdown.classList.remove('show');
        accountToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  function attachCartEventListeners() {
    const cartDropdown = $('#cart-dropdown');
    if (!cartDropdown) return;

    cartDropdown.querySelectorAll('.qty-minus').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const id = e.target.dataset.id;
        const item = cart.items.find(i => i.id === id);
        if (item && item.quantity > 1) {
          cart.updateQuantity(id, item.quantity - 1);
        }
      });
    });

    cartDropdown.querySelectorAll('.qty-plus').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const id = e.target.dataset.id;
        const item = cart.items.find(i => i.id === id);
        if (item) {
          cart.updateQuantity(id, item.quantity + 1);
        }
      });
    });

    cartDropdown.querySelectorAll('.cart-item-remove').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const id = e.target.dataset.id;
        cart.remove(id);
      });
    });
  }

  /* Newsletter form -------------------------------------------------------- */
  function initNewsletter() {
    const form = $('[data-newsletter]');
    if (!form) return;

    const input = $('input[type="email"]', form);
    const message = $('[data-newsletter-msg]', form);

    form.addEventListener('submit', (event) => {
      event.preventDefault();
      const email = input.value.trim();

      if (!email || !input.checkValidity()) {
        message.textContent = 'Please enter a valid email address.';
        return;
      }

      // Disable button during submission
      const submitBtn = form.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.textContent = 'Subscribing...';

      // Send to backend
      fetch('/newsletter/subscribe', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ email: email })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          message.textContent = data.message;
          message.style.color = '#4CAF50';
          form.reset();
          showToaster('Successfully subscribed!', 'success');
        } else {
          message.textContent = data.message;
          message.style.color = '#f44336';
          showToaster('Subscription failed. Please try again.', 'error');
        }
      })
      .catch(error => {
        console.error('Newsletter error:', error);
        message.textContent = 'Sorry, there was an error. Please try again.';
        message.style.color = '#f44336';
        showToaster('Subscription failed. Please try again.', 'error');
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Subscribe';
      });
    });
  }

  /* Toaster notification --------------------------------------------------- */
  function showToaster(message, type = 'success') {
    const toaster = document.createElement('div');
    toaster.className = `toaster toaster--${type}`;
    toaster.innerHTML = `
      <span class="toaster__message">${message}</span>
      <button class="toaster__close" aria-label="Close">×</button>
    `;
    document.body.appendChild(toaster);

    // Add close button functionality
    const closeBtn = toaster.querySelector('.toaster__close');
    closeBtn.addEventListener('click', () => {
      toaster.classList.remove('show');
      setTimeout(() => toaster.remove(), 300);
    });

    // Show with animation
    setTimeout(() => {
      toaster.classList.add('show');
    }, 10);

    // Auto-hide after 4 seconds
    setTimeout(() => {
      toaster.classList.remove('show');
      setTimeout(() => toaster.remove(), 300);
    }, 4000);
  }

  /* Search form (placeholder behaviour) ------------------------------------ */
  function initSearch() {
    const form = $('[data-search-form]');
    if (!form) return;
    form.addEventListener('submit', (event) => event.preventDefault());

    const searchInput = $('#live-search');
    const searchResults = $('#search-results');
    let searchTimeout;

    if (!searchInput || !searchResults) return;

    // Close results when clicking outside
    document.addEventListener('click', (event) => {
      if (!form.contains(event.target)) {
        searchResults.style.display = 'none';
      }
    });

    // Live search functionality
    searchInput.addEventListener('input', (event) => {
      const query = event.target.value.trim();

      clearTimeout(searchTimeout);

      if (query.length < 2) {
        searchResults.style.display = 'none';
        searchResults.innerHTML = '';
        return;
      }

      searchTimeout = setTimeout(() => {
        fetch(`/search?q=${encodeURIComponent(query)}`)
          .then(response => response.json())
          .then(data => {
            if (data.length === 0) {
              searchResults.innerHTML = '<div class="search-result-item no-results">No results found</div>';
            } else {
              searchResults.innerHTML = data.map(item => `
                <div class="search-result-item">
                  <img src="/${item.image}" alt="${item.title}" class="search-result-image">
                  <div class="search-result-info">
                    <div class="search-result-type">${item.type}</div>
                    <div class="search-result-title">${item.title}</div>
                    <div class="search-result-desc">${item.description || ''}</div>
                    ${item.price ? `<div class="search-result-price">${item.price}</div>` : ''}
                  </div>
                </div>
              `).join('');
            }
            searchResults.style.display = 'block';
          })
          .catch(error => {
            console.error('Search error:', error);
          });
      }, 300); // 300ms debounce
    });
  }

  /* Topbar dropdowns (language & currency) --------------------------------- */
  function initTopbarDropdowns() {
    const dropdownToggles = $$('[data-dropdown-toggle]');

    dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const dropdownType = toggle.dataset.dropdownToggle;
        const dropdownMenu = document.getElementById(`${dropdownType}-dropdown`);

        // Close all other dropdowns
        $$('[data-dropdown-toggle]').forEach(otherToggle => {
          if (otherToggle !== toggle) {
            const otherType = otherToggle.dataset.dropdownToggle;
            const otherMenu = document.getElementById(`${otherType}-dropdown`);
            if (otherMenu) {
              otherMenu.classList.remove('show');
            }
          }
        });

        // Toggle current dropdown
        if (dropdownMenu) {
          dropdownMenu.classList.toggle('show');
        }
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', (event) => {
      if (!event.target.closest('.topbar__dropdown')) {
        $$('.topbar__dropdown-menu').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });

    // Handle dropdown item clicks
    $$('.topbar__dropdown-item').forEach(item => {
      item.addEventListener('click', (event) => {
        event.preventDefault();
        const dropdown = item.closest('.topbar__dropdown');
        const button = dropdown.querySelector('.topbar__select');
        const value = item.textContent;

        // Update button text
        button.innerHTML = `${value} <svg class="icon icon--xs"><use href="#i-chevron"/></svg>`;

        // Close dropdown
        item.closest('.topbar__dropdown-menu').classList.remove('show');

        // Store selection (you can add localStorage persistence here)
        if (item.dataset.lang) {
          localStorage.setItem('selectedLanguage', item.dataset.lang);
        }
        if (item.dataset.currency) {
          localStorage.setItem('selectedCurrency', item.dataset.currency);
        }
      });
    });

    // Restore saved selections on page load
    const savedLang = localStorage.getItem('selectedLanguage');
    const savedCurrency = localStorage.getItem('selectedCurrency');

    if (savedLang) {
      const langButton = $('[data-dropdown-toggle="language"]');
      const langItem = document.querySelector(`[data-lang="${savedLang}"]`);
      if (langButton && langItem) {
        langButton.innerHTML = `${langItem.textContent} <svg class="icon icon--xs"><use href="#i-chevron"/></svg>`;
      }
    }

    if (savedCurrency) {
      const currencyButton = $('[data-dropdown-toggle="currency"]');
      const currencyItem = document.querySelector(`[data-currency="${savedCurrency}"]`);
      if (currencyButton && currencyItem) {
        currencyButton.innerHTML = `${currencyItem.textContent} <svg class="icon icon--xs"><use href="#i-chevron"/></svg>`;
      }
    }
  }

  /* Init ------------------------------------------------------------------- */
  document.addEventListener('DOMContentLoaded', () => {
    initNavToggle();
    $$('[data-carousel]').forEach(initCarousel);
    initCart();
    initNewsletter();
    initSearch();
    initTopbarDropdowns();
    initAccountDropdown();
  });
})();
