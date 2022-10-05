@extends('web.layouts.main')
@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up" class="text-uppercase font-weight-bold">Novel</h2>
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
              @if($banner) @foreach($banner as $val)
                <div class="swiper-slide"><img src="{{asset('/uploads/pages/'.$val->file)}}"></div>
              @endforeach @endif
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
    <section id="product" class="product-slider-min categories-slider-min product-hijab">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2"> </div>
          <div class="col-md-8">
            <div class="product-slider swiper" data-aos="fade-up">
              <div class="categories-product-min novel-book-min">
                <div class="container">
                  <div class="row">
                    @if($novel) @foreach($novel as $val)
                    <div class="col-md-4"> <img src="{{asset('/uploads/pages/'.$val->file)}}">
                      <h3><a @if($pro->price == 0) onclick="readBook({{$pro->id}})" @else href="{{route('add_to_cart',Crypt::encrypt($pro->id))}}" @endif>{{$val->name}}</a></h3> </div>
                    @endforeach @endif

                    <!-- <div class="col-md-4"> <img src="{{asset('web/img/novel2.png')}}">
                      <h3><a href="javascript:;">Dil ky dareechey</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel3.png')}}">
                      <h3><a href="javascript:;">Hareem Ishq</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel4.png')}}">
                      <h3><a href="javascript:;">Palestine</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel5.png')}}">
                      <h3><a href="javascript:;">barood</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel6.png')}}">
                      <h3><a href="javascript:;">Sanson ky is safar main</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel7.png')}}">
                      <h3><a href="javascript:;">Ishq tamaam</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel8.png')}}">
                      <h3><a href="javascript:;">Khooni Ghar</a></h3> </div>
                    <div class="col-md-4"> <img src="{{asset('web/img/novel9.png')}}">
                      <h3><a href="javascript:;">Khatron ky khiladi</a></h3> </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 hosging-adv cat-hosging-adv"> <img src="{{asset('web/img/hosting-adv.png')}}"> <img src="{{asset('web/img/power-adv.png')}}"> </div>
        </div>
      </div>
    </section>
    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('web/img/adv-img.png')}}"  class="img-fluid"> </div>
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
