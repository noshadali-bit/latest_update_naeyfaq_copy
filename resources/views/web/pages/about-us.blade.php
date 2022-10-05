@extends('web.layouts.main')
@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up" class="text-uppercase font-weight-bold">About Us</h2>
          <p data-aos="fade-up" data-aos-delay="100"> Lorem ipsum dolor sit amet, consectetur
            <br> adipiscing elit, sed do eiusmod tempor incididunt
            <br> ut labore et dolore magna aliqua.</p>
          <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
            <input type="text" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <div class="col-lg-7 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <div class="home-slider-min">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="{{asset('web/img/home-slider.png')}}"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid text-center adv-section-min pt-4">
    <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
  </section>
  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about about-page pt-0 pb-0">
      <div class="container-fluid" data-aos="fade-up">
        <div class="container">
          <div class="about-us-top-text">
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
          </div>
        </div>
        <div class="row gy-4 about-page-section">
          <div class="col-lg-6 content order-last my-auto">
            <div class="row">
              <div class="col-md-9">
                <a href="javascript:;"><img src="{{asset('web/img/logo.png')}}"></a>
                <h3>About Naeyufaq</h3>
                <p>Alhamdulillah, after a hiatus of several months, the website of our organization has been renovated according to the modem requirements and has started working again. All material of Naey Ufaq, Anchal, and hijab (2007 to November 2021) has been uploaded.</p>
                <p>Now Pakistani readers can also read our magazines on the internet for free. Especially Pakistani women and men living abroad were having difficulty in reading our magazines Naey Ufaq, Anchal, Hijab, now You can easily study them.</p> <a class="cta-btn" href="#">REad More</a> </div>
              <div class="col-md-3 hosging-adv"> <img src="{{asset('web/img/vertical-adv.png')}}"> </div>
            </div>
          </div>
          <div class="col-lg-6 position-relative align-self-start padding-0"> <img src="{{asset('web/img/about-img-2.png')}}" class="img-fluid" alt=""> </div>
        </div>
      </div>
    </section>
    <section class="full-image-secion"><img src="{{asset('web/img/ful-img.jpg')}}" class="w-100"></section>
    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
    </section>
    <section id="novel" class="novel-section-min pt-0">
      <div class="container">
        <!-- Slider main container -->
        
        @isset($categories) @foreach($categories as $cat)
        @if($cat->id == 8)
        <!-- Slider main container -->
        <div class="novle-slider swiper">
          <div class="row">
              <div class="col-md-6">
                  <div class="product-title title-left">
              <img src='{{asset("/uploads/pages/".$cat->logo)}}' class="cat_logo">
            <h3>{{$cat->name}}</h3>
            </div>
              </div>
              <div class="col-md-6">
                  <div class="product-title title-right">
              <img src='{{asset("/uploads/pages/".$cat->logo)}}' class="cat_logo">
            <h3>{{$cat->name_urdu}}</h3>
            </div>
              </div>
          </div>
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper novel-section">
          @isset($novel) @foreach($novel as $pro) @if($pro->cat_id == $cat->id)

            <div class="swiper-slide">
              <a href="{{route('view_books',Crypt::encrypt($pro->id))}}"> <img src="{{asset('/uploads/pages/'.$pro->file)}}"> </a>
            </div>

          @endif @endforeach @endisset

          </div>
          <!-- If we need navigation buttons -->
          <div class="slider-arrows slider-arrows-novel">
            <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i> </div>
            <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i> </div>
          </div>
        </div>
        @endif
        @endforeach @endisset
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

<script type="text/javascript">
  $(document).ready(function() {
    // Swiper: Slider
    new Swiper('.product-slider', {
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      slidesPerView: 4,
      spaceBetween: 20,
      breakpoints: {
        1920: {
          slidesPerView: 4,
          spaceBetween: 20
        },
        1280: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1028: {
          slidesPerView: 4,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 10
        }
      }
    });
  });
  $(document).ready(function() {
    // Swiper: Slider
    new Swiper('.novle-slider', {
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      slidesPerView: 3,
      spaceBetween: 20,
      breakpoints: {
        1920: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1028: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 10
        }
      }
    });
  });
  var swiper = new Swiper(".homeslider", {
    loop: true,
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  </script>


@endsection
