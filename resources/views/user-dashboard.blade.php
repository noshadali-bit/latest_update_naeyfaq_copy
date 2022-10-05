


@extends('web.layouts.main')
@section('content')
  <!-- ======= Hero Section ======= -->
  <!-- <main id="main"> -->
    <!-- ======= Services Section ======= -->
    
    @isset($order_item) 
    @foreach($product as $pro) 
    
    <!-- <section id="service" class="services pt-0"> -->
        <div class="card" >
              <h2>{{$pro->year}} {{$pro->month}}</h2>
            <img src="{{asset('/uploads/pages/'.$pro->file)}}" alt="" class="pro_img">
            <h4>Risala Name : {{$pro->name}}</h4>
            <div class="row">
            @foreach($page_image as $img) @if($img->product_id == $pro->id)
                <div class="col-2">
                    <img src="{{asset('/uploads/pages/'.$img->file)}}" alt="" class="pro_img">
                </div>
            @endif @endforeach

          <!-- End Card Item -->
            </div>
        </div>
    <!-- </section> -->

    @endforeach @endisset
    <!-- End Services Section -->
    <!-- ======= About Us Section ======= -->


  <!-- </main> -->
  <!-- End #main -->
  @endsection

@section('css')

<style type="text/css">
  .pro_img{
    width:200px !important;
    height:200px !important;
  }
</style>

@endsection

@section('js')

  <script>

  </script>

@endsection