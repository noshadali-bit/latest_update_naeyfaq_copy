@extends('web.layouts.main')
@section('content')

  <main id="main">
    <!-- ======= Services Section ======= -->
    
    <section id="service" class="services pt-0">
      <div class="container" data-aos="fade-up">
        <div class="section-header"> <img src="{{asset('web/img/logo.png')}}">
          <h2>Cart</h2> </div>
        <div class="row">
        
        <table class="table table-dark">
            <tr>
                <th>Product</th>
                <td><img src="{{asset('/uploads/pages/'.$product[0]->file)}}" alt="" class="pro"></td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{$product[0]->name}}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>{{$product[0]->price}}</td>
            </tr>
            <form action="{{route('place_order')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product[0]->id}}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="amount" value="{{$product[0]->price}}">
            <tr>
                <th colspan=2><h2>Billing Details</h2></th>
            </tr>

            <tr>
                <th>First Name</th>
                <td>
                  @if(Auth::user())
                    {{Auth::user()->f_name}}
                  @endif
                  @if(Auth::user()==null)
                  <input type="text" name="f_name" class="form-controll" >
                  @endif
                </td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>
                @if(Auth::user())
                    {{Auth::user()->l_name}}
                  @endif
                  @if(Auth::user()==null)
                  <input type="text" name="l_name" class="form-controll">
                  @endif
                </td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>
                @if(Auth::user())
                    {{Auth::user()->gender}}
                  @endif
                  @if(Auth::user()==null)
                  Male<input type="radio" name="gender" value="Male" class="form-controll">Female<input type="radio" name="gender" value="Female" class="form-controll">
                  @endif
                </td>
            </tr>
            <tr>
                <th>Email</th>                
                <td>
                  @if(Auth::user())
                    {{Auth::user()->email}}
                  @endif
                  @if(Auth::user()==null)
                  <input type="text" name="email" class="form-controll">
                  @endif
                </td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>
                  @if(Auth::user())
                    {{Auth::user()->phonenumber}}
                  @endif
                  @if(Auth::user()==null)
                  <input type="text" name="phonenumber" class="form-controll">
                  @endif
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" class="btn btn-primary" name="submit"></td>
            </tr>
            </form>
        </table>
          <!-- End Card Item -->
        </div>
      </div>
    </section>
    <!-- End Services Section -->
    <!-- ======= About Us Section ======= -->
 
    
  </main>
  <!-- End #main -->
  @endsection

@section('css')

<style type="text/css">
    img.pro img,.img-responsive {
        width: 60px !important;
    }
    
</style>

@endsection

@section('js')

  <script>
  </script>

@endsection