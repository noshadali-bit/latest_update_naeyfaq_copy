



@extends('web.layouts.main')
@section('content')
          <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h3 class="text-uppercase">Welcome to <div class="section-border"></div></h3>
          <h2 data-aos="fade-up" class="text-uppercase font-weight-bold">Naeyufaq</h2>
          <p data-aos="fade-up" data-aos-delay="100"> The website of our organization has been renovated according to the modem requirements and has started working again. All material of Naey Ufaq, Anchal, and hijab (2007 to November 2021) has been uploaded.</p>
          <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
            <input type="text" class="form-control" placeholder="Search..." id="search_bar">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </form>
          <div class="hero-space"></div>
          <div class="arrow-container">
            <div class="arrow-down">
              <a href="#service"><img src="{{asset('web/img/down-arrow.png')}}"> <span>Scroll Down</span></a>
            </div>
          </div>
        </div>
        <div class="col-lg-7 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <div class="homeslider swiper home-slider-min">
            <div class="swiper-wrapper">

            @if($banner) @foreach($banner as $val)
              <div class="swiper-slide"><img src="{{asset('/uploads/pages/'.$val->file)}}"></div>
            @endforeach @endif

            </div>
            <div class="slider-arrows">
              <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i> </div>
              <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i> </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->
  <section class="container-fluid text-center adv-section-min pt-4">
    <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
  </section>

  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-6">
                <div class="section-header title-left">
            <img src="{{asset('web/img/logo.png')}}">
          <h2>Our Categories</h2>
          </div>
            </div>
            <div class="col-md-6">
                <div class="section-header title-right">
            <img src="{{asset('web/img/logo.png')}}">
          <h2>ہمارے زمرے</h2>
          </div>
            </div>
        </div>
        <div class="row">
        @isset($category) @foreach($category as $cat) @if($cat->id != 8 && $cat->id != 9)

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <div class="card-img"> <img src='{{asset("uploads/pages/".$cat->file)}}' alt="" class="img-fluid"> </div> <img src="{{asset('web/img/card-bg.png')}}">
              <h3><a href="{{route('categories',Crypt::encrypt($cat->id))}}" class="stretched-link">{{$cat->name}}</a></h3> </div>
          </div>
          @endif @endforeach @endisset


          <!-- End Card Item -->
        </div>
      </div>
    </section>
    <!-- End Services Section -->
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about pt-0 pb-0">
      <div class="container-fluid" data-aos="fade-up">
        <div class="row">


          <div class="col-lg-4 content my-auto">
                <a href="javascript::void(0)"><img src="{{asset('web/img/logo.png')}}"></a>
                <h3>About Naeyufaq</h3>
                <p>Alhamdulillah, after a hiatus of several months, the website of our organization has been renovated according to the modem requirements and has started working again. All material of Naey Ufaq, Anchal, and hijab (2007 to November 2021) has been uploaded.</p>
                <p>Now Pakistani readers can also read our magazines on the internet for free. Especially Pakistani women and men living abroad were having difficulty in reading our magazines Naey Ufaq, Anchal, Hijab, now You can easily study them.</p> <a class="cta-btn" href="{{route('about_us')}}">REad More</a> </div>


          <div class="col-lg-4 position-relative abt-cntr-img pl-0"> <img src="{{asset('web/img/abt.png')}}" class="img-fluid" alt=""> </div>

          <div class="col-lg-4 content my-auto">
                <div class="abt-right-blk">
                    <a href="javascript::void(0)"><img src=""></a>
                <h3>السلام علیکم و رحمتہ الل</h3>
                <p>الحمدللہ کئی ماہ کے تعطل کے بعدہمارے ادارے کی ویب سائٹ نے جدید تقاضوں کے مطابق تزئین و آرائش سے آراستہ ہو کر دوبارہ کام کرنا شروع کر دیا ہے۔اس پر نئے افق گروپ آف پبلی کیشنز کے تحت شائع ہو نے والے مؤقر جرائد ،نئے افق،آنچل ،حجاب کا تمام مواد(2007ء سے نومبر2021ء) تک</p>
                <p>الحمدللہ کئی ماہ کے تعطل کے بعدہمارے ادارے کی ویب سائٹ نے جدید تقاضوں کے مطابق تزئین و آرائش سے آراستہ ہو کر دوبارہ کام کرنا شروع کر دیا ہے۔اس پر نئے افق گروپ آف پبلی کیشنز کے تحت شائع ہو نے والے مؤقر جرائد ،نئے افق،آنچل ،حجاب کا تمام مواد(2007ء سے نومبر2021ء) تک</p>
                <a class="cta-btn" href="{{route('about_us')}}">REad More</a>
            </div>
          </div>



        </div>
      </div>
    </section>

    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
    </section>
@php
$a = 0;
@endphp
    @isset($category) @foreach($category as $cat)
    @if($cat->id != 8 && $cat->id != 9)
    <section id="{{$cat->name}}" class="product-slider-min product-hijab">
      <div class="container-fluid" id="anchal-sec">
        <div class="row">
          <div class="col-md-2 hosging-adv"><img src="{{asset('web/img/hosting-adv.png')}}"> </div>
          <div class="col-md-8">
            <div class="product-slider swiper" data-aos="fade-up">

                <div class="row">
                    <div class="col-md-6">
                        <div class="product-title">
                          <img src='{{asset("/uploads/pages/".$cat->logo)}}' class="cat_logo">
                          <h3>{{$cat->name}}</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-title product-title-urdu">
                        <img src='{{asset("/uploads/pages/".$cat->logo)}}' class="cat_logo">
                          <h3>{{$cat->name_urdu}} </h3>
                        </div>
                    </div>
                </div>

              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">

              @isset($product) @foreach($product as $pro) @if($pro->cat_id == $cat->id)

                <div class="swiper-slide"> <a @if($pro->price == 0) onclick="readBook({{$pro->id}})" @else href="{{route('add_to_cart',Crypt::encrypt($pro->id))}}" @endif > <img src="{{asset('/uploads/pages/'.$pro->file)}}" class="pro_img"> </a>
                  <div class="pro-name">
                      <h3>{{$pro->name}}</h3>
                      <h3>{{$pro->name_urdu}} </h3>
                  </div>
                  <div class="tags">
                      <!-- <p>RS : <span>{{$pro->price}}</span></p> -->
                  <p><span>{{$pro->month}} {{$pro->year}}</span></p>
                  </div>
                  {{-- <a @if($pro->price == 0) onclick="readBook({{$pro->id}})" @else href="{{route('add_to_cart',Crypt::encrypt($pro->id))}}" @endif class="cta-btn">@if($pro->price == 0) Read More @else Add To Bucket List @endif </a> --}}
                  <a href="{{route('view_books',Crypt::encrypt($pro->id))}}" class="cta-btn"> Read More </a>
                </div>
                @endif @endforeach @endisset

              </div>
              <div class="slider-arrows">
                <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i> </div>
                <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i> </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 hosging-adv"><img src="{{asset('web/img/hosting-adv.png')}}"> </div>
        </div>
      </div>
    </section>
    @endif
    @endforeach @endisset

    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
    </section>
    <section id="Novel" class="novel-section-min pt-0">
      <div class="container">
        @isset($category) @foreach($category as $cat)
        @if($cat->id == 8)
        <!-- Slider main container -->
        <div class="novle-slider swiper">
          <div class="row">
            <div class="col-md-6">
              <div class="product-title title-left">
                <a href="{{route('novel')}}">
                  <img src='{{asset("/uploads/pages/".$cat->logo)}}' class="cat_logo">
                  <h3>{{$cat->name}}</h3>
                </a>
            </div>
              </div>
              <div class="col-md-6">
                <div class="product-title title-right">
                <a href="{{route('novel')}}">
                  <img src='{{asset("/uploads/pages/".$cat->logo)}}' class="cat_logo">
                  <h3>{{$cat->name_urdu}}</h3>
                </a>
            </div>
              </div>
          </div>
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper novel-section">
          @isset($product) @foreach($product as $pro) @if($pro->cat_id == $cat->id)
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
  <!-- END: Content-->
  @endsection

@section('css')

<style type="text/css">
  .pro_img{
    width:200px !important;
    height:200px !important;
  }
  .cat_logo{
    width:80px !important;
  }
</style>

@endsection
@section('js')

  <script>
    @isset($message)
      toastr.success("{{$message}}",'Success!');
    @endisset

    $(document).ready(function() {
      $("#search_bar").keypress(function() {
        var dInput = $('#search_bar').val();
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: "{{ route('search_detail') }}",
          data: {"_token":"{{ csrf_token() }}",'search': dInput},
          success: function(response) {
              console.log(response);
              toastr.success("Message Sent.");
          }
        });
      });


    });
  </script>

@endsection

