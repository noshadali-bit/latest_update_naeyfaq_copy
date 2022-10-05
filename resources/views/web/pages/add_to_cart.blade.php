@extends('web.layouts.main')
@section('content')
                <!-- START: Main Content-->


    <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about product-detail-page">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-6 content order-last my-auto">
            {{-- {{dd($product[0])}} --}}
            <h3>{{$product[0]->post_title}}</h3>
            <h3>{{$product[0]->post_title_urdu}}</h3>
            <p>{{$product[0]->writer_name}}</p>
            <div class="product-price">
              @if($product[0]->price == 0)
              <h3>Free</h3></div>
              @else
              <h3>{{$product[0]->price}} RS</h3></div>
              @endif
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
              <option selected>{{$product[0]->month}} {{$product[0]->year}}</option>
            </select> <a class="cta-btn" href="{{route('checkout',Crypt::encrypt($product[0]->id))}}">Add To Bucket List</a> </div>
          <div class="col-lg-6">
            <div class="product-detail-img"> <img src="{{asset('/uploads/pages/'.$product[0]->file)}}" class="img-fluid" alt=""> </div>
          </div>
        </div>
      </div>
    </section>
    <section class="container-fluid text-center adv-section-min pt-4">
      <div class="adv-section"> <img src="{{asset('/web/img/adv-img.png')}}" class="img-fluid"> </div>
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
              <a  @if($pro->price == 0) onclick="readBook({{$pro->id}})" @else href="{{route('add_to_cart',Crypt::encrypt($pro->id))}}" @endif>
              <img src="{{asset('/uploads/pages/'.$pro->file)}}"></a>
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

  <script>

</script>

@endsection
