@extends('web.layouts.main')
@section('content')        
                <!-- START: Main Content-->
        
  <main id="main">
    <!-- ======= Services Section ======= -->
    
    
  </main>
  <!-- End #main -->
  
  <section class="checkout-sec all-section">
					
		<div class="container">
			<div class="body-space">
				<form class="checkout-form" action="{{route('place_order')}}" method="POST">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8">
							<div class="billing">
								<p>Returning customer? <a href="#">Click here to login</a></p>
							</div>
							<h2 class="">Billing Address</h2>
							@csrf
							<input type="hidden" name="product_id" value="{{$product[0]->id}}">
							<input type="hidden" name="qty" value="1">
							<input type="hidden" name="shipping_charges" value="{{$shipping_charges}}">
							<input type="hidden" name="amount" value="{{$product[0]->price}}">
							
							<div class="row">

								<div class="form-group col-md-6">
									<label class="col-md-3">Country</label>
									<select class="col-md-9" name="country">
										<option>Pakistan</option>
										<option>United state of americe</option>
									</select>
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">First Name</label>
									@if(Auth::user())
									<input type="text" name="f_name" class="col-md-9" value="{{Auth::user()->f_name}}" disabled>
									@endif
									@if(Auth::user()==null)
									<input type="text" name="f_name" class="col-md-9" >
									@endif
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Last Name</label>
									@if(Auth::user())
									<input type="text" name="l_name" class="col-md-9" value="{{Auth::user()->l_name}}" disabled>
									@endif
									@if(Auth::user()==null)
									<input type="text" name="l_name" class="col-md-9">
									@endif
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-3"> Gender</label>
									@if(Auth::user())
									<input type="text" name="gender" class="col-md-9" value="{{Auth::user()->gender}}" disabled>
									@endif
									@if(Auth::user()==null)
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="gender" id="gender1" value="Male">
										<label class="form-check-label" for="gender1">Male</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="gender" id="gender2" value="Female">
										<label class="form-check-label" for="gender2">Female</label>
									</div>
									@endif
									
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Address</label>
									<input type="text" name="address" class="col-md-9" placeholder="Street Address">
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Town / City</label>
									<input type="text" name="city" class="col-md-9" placeholder="Town / City">
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Email </label>
									@if(Auth::user())
									<input type="text" name="email" class="col-md-9" value="{{Auth::user()->email}}" disabled>
									@endif
									@if(Auth::user()==null)
									<input type="text" name="email" class="col-md-9">
									@endif
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Phone</label>
									@if(Auth::user())
									<input type="text" name="phonenumber" class="col-md-9" value="{{Auth::user()->phonenumber}}" disabled>
									
									@endif
									@if(Auth::user()==null)
									<input type="text" name="phonenumber" class="col-md-9">
									@endif
								</div>

							</div>
							@if($product[0]->price != 0)
							<h2 class="">Shipping Address</h2>

							<div class="row">

								
								<div class="form-group col-md-6">
									<label class="col-md-3">First Name</label>
									<input type="text" name="shipping_f_name" class="col-md-9" >	
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Last Name</label>
									<input type="text" name="shipping_l_name" class="col-md-9">
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Email </label>
									<input type="text" name="shipping_email" class="col-md-9">
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3">Phone</label>
									<input type="text" name="shipping_phonenumber" class="col-md-9">
								</div>
								
								<div class="form-group col-md-6">
									<label class="col-md-3"> Gender</label>
									
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="shipping_gender" id="gender1" value="Male">
										<label class="form-check-label" for="gender1">Male</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="shipping_gender" id="gender2" value="Female">
										<label class="form-check-label" for="gender2">Female</label>
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-3">Country</label>
									<select class="col-md-9" name="shipping_country">
										<option>Pakistan</option>
										<option>United state of americe</option>
									</select>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-3">Town / City</label>
									<input type="text" name="shipping_city" class="col-md-9" placeholder="Town / City">
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-3">Address</label>
									<input type="text" name="shipping_address" class="col-md-9" placeholder="Street Address">
								</div>
																
							</div>
							@endif
						</div>

						<div class="col-md-4">
						<div class="order-detail-table">
							<h3>Your Order</h3>
							<table>
								<tbody><tr>
									<td>Card Subtotal x 1</td>
									<td> 
										@if($product[0]->price == 0)
											Free
										@else
											{{$product[0]->price}} RS
										@endif
										</td>
								</tr>
								@if($product[0]->price != 0)
								<tr>

									<td>Shipping</td>
									<td>
										@if($shipping_charges != 0)
											{{$shipping_charges}}
										@else
											Free Shipping
										@endif	
									</td>
								</tr>
								@endif
								<tr>
									<td>Order Total</td>
									<td> 
										@if($product[0]->price == 0)
											Free
										@else
											{{$product[0]->price+$shipping_charges}} RS
										@endif
									</td>
								</tr>
							</tbody></table>
							@if($product[0]->price != 0)
							<h3 class="color-payment">Payment Method</h3>
							
							<!-- <form class="form_checkout_space"> -->
								<p class="credit-card">Credit Card</p>
								<div class="checkbox">
									<label>
										<input type="checkbox"><img src="https://webnappservices.com/naeyufaq/dev/public/web/img/visa.png" class="img-responsive" alt="images">
									</label>
								</div>
								
								<div class="checkbox checkbox-flex">
									<div class="american ">
										<p>American Express</p>
										<label>
											<input type="checkbox"><span> <img class="img-responsive" alt="" src="https://webnappservices.com/naeyufaq/dev/public/web/img/american.png"></span>
										</label>
									</div>
									<div class="american">
										<p>Pay Pal</p>
										<label>
											<input type="checkbox"><span> <img class="img-responsive" alt="" src="https://webnappservices.com/naeyufaq/dev/public/web/img/paypal.png"></span>
										</label>
									</div>
									
								</div>
								@endif
								<div class="form-group text-center">
								<input type="submit" class="theme-btn btn btn-primary" name="submit" value="Place Order">
									<!-- <a href="#" class="theme-btn">Place Order</a> -->
								</div>
							<!-- </form> -->
						</div>
						</div>
					</div>
				</form>
				</div>  
			</div>
		</section>
  


@endsection

@section('css')

<style type="text/css">
	.checkout-form input, .checkout-form select {
	    min-height: 15px;
	}
	img.img-responsive {
        width: 60px;
    }
</style>

@endsection

@section('js')

  <script>
  </script>

@endsection