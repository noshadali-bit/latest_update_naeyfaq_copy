@extends('layouts.main')
@section('content')
<!-- START: Card Data-->
<main>
   <div class="container-fluid site-width">
      <!-- START: Card Data-->
      <div class="row">
         <div class="col-12 mt-3">
            <div class="card">
               <div class="card-header justify-content-between align-items-center">
                  <h4 class="card-title">Add Product</h4>
               </div>
               <div class="card-body">
                  <div class="table-responsive">

                  <form action="{{route('add_product')}}" method="POST" enctype="multipart/form-data">
                     @csrf

                     <div class="mb-3 form-check">
                        <label for="productcategory" class="form-label">Category</label>
                        <select class="form-control" name="cat_id" id="productcategory" >
                            @if($category) @foreach($category as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach @endif
                        </select>
                     </div>

                     <div class="mb-3 form-check">
                        <label for="productname" class="form-label">Year</label>
                        <select class="form-control" name="year" id="productyear" >
                            <option value=''>--Select Month--</option>
                            @for ($i = 2000; $i < 2050; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                     </div>

                     <div class="mb-3 form-check">
                        <label for="productname" class="form-label">Month</label>
                        <select class="form-control" name="month" id="productyear" >
                            <option value=''>--Select Month--</option>
                            <option selected value='Jan'>Jan</option>
                            <option value='Feb'>Feb</option>
                            <option value='Mar'>Mar</option>
                            <option value='Apr'>Apr</option>
                            <option value='May'>May</option>
                            <option value='Jun'>Jun</option>
                            <option value='Jul'>Jul</option>
                            <option value='Aug'>Aug</option>
                            <option value='Sep'>Sep</option>
                            <option value='Oct'>Oct</option>
                            <option value='Nov'>Nov</option>
                            <option value='Dec'>Dec</option>
                     </div>

                     {{-- <div class="mb-3">
                        <label for="productname" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="productname" placeholder="Name" required>
                     </div>

                     <div class="mb-3">
                        <label for="productname" class="form-label">Urdu Name</label>
                        <input type="text" name="name_urdu" class="form-control" id="productname" placeholder="Name" required>
                     </div>
                     <div class="mb-3">
                        <label for="productmonth" class="form-label">Date</label>
                        <input type="month" name="month" class="form-control" id="productmonth" placeholder="Month" required>
                     </div>
                     <div class="mb-3">
                        <label for="productprice" class="form-label">Pricce</label>
                        <input type="number" name="price" class="form-control" id="productprice" placeholder="Price" required>
                     </div>
                     <div class="mb-3">
                        <label for="productdecs" class="form-label">Description</label>
                        <textarea name="description" id="productdecs" class="form-control" placeholder="Description"  required></textarea>
                     </div> --}}

                     <br>
                     <br>

                     <div class="mb-3 form-check">

                        <label for="productname" class="form-label">Upload Title</label>
                        <input type="file" name="product_img_1" class="form-control" id="1" required>
                     </div>
                     {{-- <button class="btn btn-primary add_more_product" id="1">Add More</button> --}}

                     <input type="submit" class="btn btn-primary form-check" value="Submit" name="submit">
                  </form>

                  </div>
                  <div class="card">
                     <br />
                     <br />
                     <br />
                     <br />
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- END: Card DATA-->
   </div>
</main>

<!-- END: Card DATA-->
@endsection
@section('link')
@endsection

@section('script')
@endsection

@section('css')
@endsection

@section('js')
<script type="text/javascript">
   $(".add_more_product").click(function(){
      event.preventDefault()
      var id = $(this).attr("id");

      var num = id;
      id++;
      $(this).attr("id", id);
      // alert(id)
      // $("#add_more_images").insertAfter("<div class='mb-3' id='add_more_images1'> <div class='input-group mb-3'> <label class='input-group-text' for='product_img_2'>Upload Title</label> <input type='file' name='product_img_1' class='form-control' id='product_img_1' required> </div> </div>")

      $("#add_more_product_"+ num).after(function() {
      return "<div class='mb-3' id='add_more_product_"+id+"'> <div class='input-group mb-3'> <label class='input-group-text' for='product_img_"+id+"'>Image "+num+"</label> <input type='file' name='product_img_"+id+"' class='form-control' id='"+id+"' required> </div> </div>";
      });
   })

</script>
@endsection
