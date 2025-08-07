 <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>Best Offer</h4>
            <h2>New Arrivals On Sale</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Flash Deals</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Last Minute</h4>
            <h2>Grab last minute deals</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    @include('user.app.latestProducts')
     @yield('content')

 <div class="best-features">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>About Our Accessories</h2>
        </div>
      </div>
      <div class="col-md-6">
        <div class="left-content">
          <h4>Looking for the most elegant girls accessories?</h4>
          <p>Our accessories collection is specially designed to match every girl's unique style and personality. From delicate necklaces to stylish handbags, discover a variety of high-quality products that enhance beauty and confidence.</p>
          <ul class="featured-list">
            <li><a href="#">Elegant handmade necklaces</a></li>
            <li><a href="#">Trendy bracelets & bangles</a></li>
            <li><a href="#">Stylish handbags and wallets</a></li>
            <li><a href="#">Colorful scarves and hats</a></li>
            <li><a href="#">Unique gifts for special occasions</a></li>
          </ul>
          <a href="{{ route('ourProductsUser') }}" class="filled-button">View Products</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="right-image">
          <img src="{{ asset('assets/images/feature-image.jpg') }}" alt="Girls Accessories">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="call-to-action">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="inner-content">
          <div class="row">
            <div class="col-md-8">
              <h4>Trendy &amp; Elegant <em>Girls</em> Accessories</h4>
              <p>Shop our exclusive range of girls accessories that blend fashion, elegance, and creativity — perfect for every occasion.</p>
            </div>
            <div class="col-md-4">
              <a href="{{ route('ourProductsUser') }}" class="filled-button">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
