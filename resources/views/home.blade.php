@extends('layouts.app')

@section('content')

    <!-- Hero -->
    @if($hero)
    <section class="hero" aria-label="More Than Giftz">
      <img class="hero__img" src="{{ asset($hero->image_path) }}" alt="{{ $hero->alt_text ?? 'Corporate gifts' }}">
      <img class="hero__logo" src="{{ asset($hero->logo_path) }}" alt="{{ $hero->logo_alt_text ?? 'More Than Giftz' }}">
    </section>
    @endif

    <!-- Shop by category -->
    @if($categories && $categories->count() > 0)
    <section class="section">
      <div class="container">
        <h2 class="section__title">Shop by Category</h2>
        <div class="category-grid">
        @foreach($categories as $category)
        <article class="category-card">
          <img class="category-card__img" src="{{ asset($category->image_path) }}" alt="{{ $category->alt_text ?? $category->title }}" loading="lazy">
          <div class="category-card__body">
            <h3 class="category-card__title">{{ $category->title }}</h3>
            @if($category->items && is_array($category->items))
            <ul class="category-card__list">
              @foreach($category->items as $item)
              <li>{{ $item }}</li>
              @endforeach
            </ul>
            @endif
          </div>
          <a class="category-card__link" href="{{ $category->link_url ?? '#' }}">{{ $category->link_text ?? 'View all' }}</a>
        </article>
        @endforeach
        </div>
      </div>
    </section>
    @endif

    <!-- Trust bar -->
    @if($trustItems && $trustItems->count() > 0)
    <section class="trust" aria-label="Why choose us">
      <ul class="trust__list">
        @foreach($trustItems as $item)
        <li class="trust__item">
          <img class="trust__icon" src="{{ asset($item->icon_path) }}" alt="" width="36" height="38">
          <p class="trust__text">
            <strong class="trust__title">{{ $item->title }}</strong>
            @if($item->stars)
            <span class="trust__stars" aria-label="5 stars">{{ $item->stars }}</span>
            @endif
            @if($item->subtitle)
            <span class="trust__sub">{{ $item->subtitle }}</span>
            @endif
          </p>
        </li>
        @endforeach
      </ul>
    </section>
    @endif

    <!-- Featured products -->
    @if($featuredProducts && $featuredProducts->count() > 0)
    <section class="band" data-carousel>
      <div class="container">
        <h2 class="section__title">Featured Products</h2>
        <div class="carousel__track carousel__track--5">
          @foreach($featuredProducts as $product)
          <article class="featured-card" data-product-id="{{ $product->id }}" data-product-type="featured">
            <img class="featured-card__img" src="{{ asset($product->image_path) }}" alt="{{ $product->alt_text ?? $product->title }}" loading="lazy">
            <div class="featured-card__body">
              <h3 class="featured-card__title">{{ $product->title }}</h3>
              <p class="featured-card__desc">{{ $product->description ?? '' }}</p>
              <p class="price">{{ $product->price }}</p>
              <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text={{ $product->whatsapp_message ?? 'Hi%2C%20I%20am%20interested%20in%20' . urlencode($product->title) }}" target="_blank" rel="noopener" aria-label="Enquire about {{ $product->title }} on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
            </div>
          </article>
          @endforeach
        </div>
        <div class="dots" role="tablist" aria-label="Slides"><button class="dots__dot is-active" type="button" data-dot="0" aria-label="Go to slide 1"></button><button class="dots__dot" type="button" data-dot="1" aria-label="Go to slide 2"></button><button class="dots__dot" type="button" data-dot="2" aria-label="Go to slide 3"></button><button class="dots__dot" type="button" data-dot="3" aria-label="Go to slide 4"></button></div>
      </div>
    </section>
    @endif

    <!-- Drinkware & kitchenware -->
    @if($productSections && $productSections->count() > 0)
    @foreach($productSections as $section)
    <section class="section section--after-band" data-carousel>
      <div class="container">
        <h2 class="section__title">{{ $section->title }}</h2>
        @if($section->subtitle)
        <p class="section__subtitle">{{ $section->subtitle }}</p>
        @endif
        <div class="carousel__track carousel__track--7">
          @if($section->products && $section->products->count() > 0)
          @foreach($section->products as $product)
          <article class="product-card" data-product-id="{{ $product->id }}" data-product-type="section">
            <h3 class="product-card__title">{{ $product->title }}</h3>
            @if($product->code)
            <p class="product-card__code">{{ $product->code }}</p>
            @endif
            <img class="product-card__img" src="{{ asset($product->image_path) }}" alt="{{ $product->alt_text ?? $product->title }}" loading="lazy">
            <p class="price">{{ $product->price }}</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text={{ $product->whatsapp_message ?? 'Hi%2C%20I%20am%20interested%20in%20' . urlencode($product->title) }}" target="_blank" rel="noopener" aria-label="Enquire about {{ $product->title }} on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>
          @endforeach
          @endif
        </div>
        <div class="dots" role="tablist" aria-label="Slides"><button class="dots__dot is-active" type="button" data-dot="0" aria-label="Go to slide 1"></button><button class="dots__dot" type="button" data-dot="1" aria-label="Go to slide 2"></button><button class="dots__dot" type="button" data-dot="2" aria-label="Go to slide 3"></button><button class="dots__dot" type="button" data-dot="3" aria-label="Go to slide 4"></button></div>
      </div>
    </section>
    @endforeach
    @endif

    <!-- Gift sets -->
    <section class="section" data-carousel>
      <div class="container">
        <h2 class="section__title">Gift Sets</h2>
        <p class="section__subtitle">We have unique Apparels no matter how you put it</p>
        <div class="carousel__track carousel__track--7">
          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-1.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>

          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-2.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>

          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-3.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>

          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-4.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>

          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-5.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>

          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-6.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>

          <article class="product-card">
            <h3 class="product-card__title">Leather Gift Set</h3>
            <p class="product-card__code">SG4883</p>
            <img class="product-card__img" src="{{ asset('assets/images/gift-7.jpg') }}" alt="Leather Gift Set" loading="lazy">
            <p class="price">50.00 AED</p>
            <div class="card-actions">
            <button class="btn btn--cart" type="button" data-add-to-cart>Add to cart</button>
            <a class="btn btn--wa" href="https://wa.me/971557863450?text=Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set" target="_blank" rel="noopener" aria-label="Enquire about Leather Gift Set on WhatsApp"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          </div>
          </article>
        </div>
        <div class="dots" role="tablist" aria-label="Slides"><button class="dots__dot is-active" type="button" data-dot="0" aria-label="Go to slide 1"></button><button class="dots__dot" type="button" data-dot="1" aria-label="Go to slide 2"></button><button class="dots__dot" type="button" data-dot="2" aria-label="Go to slide 3"></button><button class="dots__dot" type="button" data-dot="3" aria-label="Go to slide 4"></button></div>
      </div>
    </section>

    <!-- Brands -->
    @if($brands && $brands->count() > 0)
    <section class="section">
      <div class="container">
        <h2 class="section__title">Our Brands</h2>
        <ul class="brands">
        @foreach($brands as $brand)
        <li><a class="brands__tile" href="{{ $brand->link_url ?? '#' }}"><img src="{{ asset($brand->image_path) }}" alt="{{ $brand->alt_text ?? $brand->name }}" loading="lazy"></a></li>
        @endforeach
        </ul>
      </div>
    </section>
    @endif

    <!-- About banner -->
    @if($aboutBanner)
    <section class="section section--tight">
      <div class="container">
        <div class="about">
          <div class="about__text">
            <h2 class="about__title">{{ $aboutBanner->title }}</h2>
            <p class="about__desc">{{ $aboutBanner->description ?? '' }}</p>
          </div>
          <img class="about__img" src="{{ asset($aboutBanner->image_path) }}" alt="{{ $aboutBanner->alt_text ?? 'About' }}" loading="lazy">
        </div>
      </div>
    </section>
    @endif

    <!-- Clients -->
    @if($clients && $clients->count() > 0)
    <section class="section section--tight" data-carousel>
      <div class="container">
        <h2 class="section__title">Clients in</h2>
        <ul class="carousel__track clients">
          @foreach($clients as $client)
          <li class="clients__item"><img src="{{ asset($client->image_path) }}" alt="{{ $client->alt_text ?? 'Client logo' }}" loading="lazy"></li>
          @endforeach
        </ul>
        <div class="dots" role="tablist" aria-label="Slides"><button class="dots__dot is-active" type="button" data-dot="0" aria-label="Go to slide 1"></button><button class="dots__dot" type="button" data-dot="1" aria-label="Go to slide 2"></button><button class="dots__dot" type="button" data-dot="2" aria-label="Go to slide 3"></button><button class="dots__dot" type="button" data-dot="3" aria-label="Go to slide 4"></button></div>
      </div>
    </section>
    @endif

    <!-- Reviews -->
    @if($reviews && $reviews->count() > 0)
    <section class="section" data-carousel>
      <div class="container">
        <h2 class="section__title">What Our Clients Said</h2>
        <div class="carousel__track carousel__track--reviews">
          @foreach($reviews as $review)
          <article class="review">
            <header class="review__head">
              <span class="review__avatar" aria-hidden="true">{{ $review->avatar ?? 'G' }}</span>
              <div class="review__meta">
                <p class="review__name">{{ $review->name }}</p>
                <p class="review__time">{{ $review->time ?? '' }}</p>
              </div>
              @if($review->platform_icon)
              <img class="review__google" src="{{ asset($review->platform_icon) }}" alt="{{ $review->platform ?? 'Platform' }}" width="18" height="18">
              @endif
            </header>
            <p class="review__stars" aria-label="5 out of 5 stars">{{ $review->stars }}</p>
            <p class="review__text">{{ $review->review_text }}</p>
            @if($review->link_url)
            <a class="review__more" href="{{ $review->link_url }}">Read more</a>
            @endif
          </article>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    <!-- CTA strip -->
    @if($ctaSection)
    <section class="section section--cta">
      <div class="container">
        <div class="cta">
          <div class="cta__text">
            @if($ctaSection->eyebrow)
            <p class="cta__eyebrow">{{ $ctaSection->eyebrow }}</p>
            @endif
            <h2 class="cta__title">{!! $ctaSection->title !!}</h2>
            @if($ctaSection->subtitle)
            <p class="cta__sub">{{ $ctaSection->subtitle }}</p>
            @endif
          </div>
          @if($ctaSection->bow_image_path)
          <img class="cta__bow" src="{{ asset($ctaSection->bow_image_path) }}" alt="" loading="lazy">
          @endif
          <a class="cta__button" href="{{ $ctaSection->button_url }}" target="_blank" rel="noopener">{{ $ctaSection->button_text }} <svg class="icon icon--xs"><use href="#i-arrow"/></svg></a>
          @if($ctaSection->features && is_array($ctaSection->features))
          <ul class="cta__features">
            @foreach($ctaSection->features as $feature)
            <li class="cta__feature">
              <img src="{{ asset($feature['icon'] ?? '') }}" alt="" width="34" height="34">
              <strong>{{ $feature['title'] ?? '' }}</strong>
              <span>{{ $feature['subtitle'] ?? '' }}</span>
            </li>
            @endforeach
          </ul>
          @endif
        </div>
      </div>
    </section>
    @endif

@endsection
