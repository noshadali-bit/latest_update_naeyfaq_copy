@extends('web.layouts.main')
@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up" class="text-uppercase font-weight-bold">Shop Now</h2>
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
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->
  <section class="container-fluid text-center adv-section-min pt-4">
    <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}"  class="img-fluid"> </div>
  </section>
  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="service" class="services categories-page-sec pt-0">
      <div class="container" data-aos="fade-up">
        @php
        $logo = $category[0]->logo;
        @endphp
        <div class="section-header"> <img src='{{asset("uploads/pages/$logo")}}' class="cat_logo">
          <h2>Our Categories</h2> </div>
        <div class="row">
          @if(isset($category))
          @foreach($category as $cat)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100"></div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <div class="card-img"> <img src='{{asset("uploads/pages/$cat->file")}}' alt="" class="img-fluid"> </div> <img src="{{asset('web/img/card-bg.png')}}">
              <h3><a href="javascript:;">{{$cat->name}}</a></h3>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="select_on_year">
              @if(isset($product_year))
              @foreach($product_year as $pro)
                <option selected>{{$category[0]->name}} {{$pro->year}} </option>
              @endforeach
              @endif
              </select>
            </div>
          </div>
          @endforeach
          @else
          @endif

        </div>
      </div>
    </section>
    <!-- End Services Section -->
    <!-- ======= About Us Section ======= -->

    <style>

    .flipbookkk{
        margin-top: 15vh !important;
        margin-bottom: 5vh !important;

    }

    .flipbookkk-title{
        color: #ffa200;
        text-align: center;
        font-size: 5vw !important;
        font-family: "Poppins", Sans-serif;
        font-weight: 900;
        line-height: 75px;
       text-shadow: 1px 3px 0px #373737;
    }

    @media(min-width: 768px){
        .flipbookkk-title{
        font-size: 2.5vw !important;
    }

    }
    </style>

    <section id="product" class="product-slider-min categories-slider-min product-hijab">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2 hosging-adv cat-hosging-adv"> <img src="{{asset('web/img/hosting-adv.png')}}">  </div>
          <div class="col-md-8">
            <div class="product-slider swiper" data-aos="fade-up">
              <div class="categories-product-min categories-product-iner-min">
                <div class="container">
                  <div class="row" id="year-wise_pro">
                    @if(isset($products))
                    @foreach($products as $pro)

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <div class="swiper-slide"> <a href="{{route('view_books',Crypt::encrypt($pro->id))}}"><img src='{{asset("uploads/pages/$pro->file")}}' class="img-fluid"></a>
                        <h3>{{$pro->name}} </h3>
                        <a href="{{route('view_books',Crypt::encrypt($pro->id))}}" class="cta-btn"> Read More </a>
                        </div>
                    </div>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 hosging-adv cat-hosging-adv"> <img src="{{asset('web/img/hosting-adv.png')}}"> </div>
        </div>
      </div>
    </section>
    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}" class="img-fluid"> </div>
    </section>
    <section id="novel" class="novel-section-min pt-0">
      <div class="container">
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
.cat_logo{
  width:100px;
}
.product-slider .swiper-slide a.cta-btn {
    transform: none !important;
    position: initial !important;
    height: auto;
    margin: 0 auto;
    display: block;
    font-size: 13px !important;
    padding: 12px 5px;
}

.product-slider .swiper-slide h3 {
    margin: 10px 0 0;
}

.product-slider .swiper-slide {
    height: auto;
    padding: 6px 0 20px;
    margin-bottom: 20px;
    overflow: hidden;
}
.categories-product-min.categories-product-iner-min {
    scroll-behavior: smooth;
    overflow: scroll;
    height: 1000px;
}
embed.slick-slide.slick-current.slick-active {
    height: 700px;
}
</style>

@endsection

@section('js')

    <script>

   $("#select_on_year").change(function(){

        var asset = "{{ asset('') }}";
        var route = "{{route('view_books')}}";
        
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: "{{ route('search_on_year') }}",
          data: {
            "_token":"{{ csrf_token() }}",
            'search': $(this).val(),
            'cat_id': {{$category[0]->id}}
        },
          success: function(response) {

            var con = '';

            var product = jQuery.map(response.products, function(val) {

                var setImg = asset + "/uploads/pages/" + val.file;
                
                var setRoute = route+"/{{Crypt::encrypt('+val.id+')}}/"+val.id;
                console.log(setRoute)
                    
                con +="<div class='col-lg-3 col-md-4 col-sm-4 col-xs-12'>"+
                    "<div class='swiper-slide'> <a href='"+setRoute+"'>"+
                    "<img src='"+setImg +"' class='img-fluid'></a><h3>"+val.name+"</h3>"+
                    "<a href='"+setRoute+"' class='cta-btn'> Read More </a>"+
                    "</div></div>";

            });

            $("#year-wise_pro").empty().append(con);
          }
        });
    })

  </script>

@endsection
