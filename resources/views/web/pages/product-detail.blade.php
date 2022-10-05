@extends('web.layouts.main')
@section('content')
  <!-- End Header -->
  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about product-detail-page">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-6 content order-last my-auto">
            <h3>Lorem ipsum dolor sit amet, consectetur</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit..</p>
            <div class="product-count">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-dark btn-sm" id="minus-btn"><i class="fa fa-minus"></i></button>
                </div>
                <input type="number" id="qty_input" class="form-control form-control-sm" value="1" min="1">
                <div class="input-group-prepend">
                  <button class="btn btn-dark btn-sm" id="plus-btn"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="product-price">
              <h3>$100.00</h3></div>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
              <option selected>ANCHAL 2021</option>
              <option value="1">ANCHAL 2022</option>
            </select> <a class="cta-btn" href="#">Add To Cart</a> </div>
          <div class="col-lg-6">
            <div class="product-detail-img"> <img src="{{asset('web/img/product-img.png')}}" class="img-fluid" alt=""> </div>
          </div>
        </div>
      </div>
    </section>
    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
    </section>
    <section id="novel" class="novel-section-min pt-0">
      <div class="container">
        <!-- Slider main container -->
        <div class="novle-slider swiper">
          <div class="product-title"> <img src="{{asset('web/img/logo.png')}}">
            <h3>Novel</h3> </div>
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper novel-section">
            <div class="swiper-slide"><img src="{{asset('web/img/novel-1.jpg')}}"></div>
            <div class="swiper-slide"><img src="{{asset('web/img/novel-2.jpg')}}"></div>
            <div class="swiper-slide"><img src="{{asset('web/img/novel-3.jpg')}}"></div>
            <div class="swiper-slide"><img src="{{asset('web/img/novel-1.jpg')}}"></div>
            <div class="swiper-slide"><img src="{{asset('web/img/novel-2.jpg')}}"></div>
            <div class="swiper-slide"><img src="{{asset('web/img/novel-3.jpg')}}"></div>
          </div>
          <!-- If we need navigation buttons -->
          <div class="slider-arrows slider-arrows-novel">
            <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i> </div>
            <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i> </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->
  @endsection

@section('css')

<style type="text/css">
</style>

@endsection

@section('js')

  <script>
  </script>

@endsection
