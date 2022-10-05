@extends('web.layouts.main')
@section('content')
  <!-- End Header -->
  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about product-detail-page">
      <div class="container" data-aos="fade-up">
        <div class="row">
            @foreach($book as $val)
            <div class="col-lg-4 content order-last my-auto">
              <div class="inner-space">
                
                <h3><b>Book Title</b><!-- {{$val->post_title}} -->{{$val->post_title_urdu}}</h3>
                <!-- <h3><b>Urdu Title</b></h3> -->
                <p class="two"><b>Auther</b></p>
                <p>{{$val->writer_name}}</p>
                {{-- <a class="cta-btn" href="#">Read Book</a> --}}
                <a @if($val->price == 0) onclick="readBook({{$val->id}})" @else href="{{route('add_to_cart',Crypt::encrypt($val->id))}}" @endif class="cta-btn">@if($val->price == 0) Read Book @else Add To Bucket List @endif </a>

                {{-- <a onclick="readBook({{$val->id}})" class="cta-btn">Read Book</a> --}}
              </div>
            </div>
            @endforeach
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
            @isset($novel) @foreach($novel as $pro)
                <div class="swiper-slide">
                {{-- <a @if($pro->price == 0) onclick="readBook({{$pro->id}})" @else href="{{route('add_to_cart',Crypt::encrypt($pro->id))}}" @endif>
                <img src="{{asset('/uploads/pages/'.$pro->file)}}"></a> --}}
                <a href="{{route('view_books',Crypt::encrypt($pro->id))}}"> <img src="{{asset('/uploads/pages/'.$pro->file)}}"> </a>
                </div>

           @endforeach @endisset
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
