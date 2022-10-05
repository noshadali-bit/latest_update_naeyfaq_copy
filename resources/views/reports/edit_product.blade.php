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
                  <h4 class="card-title">Edit Product</h4>
               </div>
               <div class="card-body">
                  <div class="table-responsive">

                  <form action="{{route('edit_product')}}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="prod_id" value="{{$product[0]->id}}">
                     <div class="mb-3">
                        <label for="productname" class="form-label">Name</label>
                        <input type="text" value="{{$product[0]->name}}" name="name"  class="form-control" id="productname" placeholder="Name" required>
                     </div>
                     <div class="mb-3">
                        <label for="productname" class="form-label">Urdu Name</label>
                        <input type="text" value="{{$product[0]->name_urdu}}" name="name_urdu"  class="form-control" id="productname" placeholder="Name" required>
                     </div>
                     <div class="mb-3">
                        <label for="productdecs" class="form-label">Description</label>
                        <textarea name="description" id="productdecs" class="form-control" placeholder="Description"  required>{{$product[0]->description}}</textarea>
                     </div>
                     <div class="mb-3">
                        <label for="productdate" class="form-label">Date</label>
                        <input type="month" name="month" id="productdate" class="form-control" value="{{$product[0]->year}}-{{$product[0]->month}}">
                     </div><div class="mb-3">
                        <label for="productprice" class="form-label">Price</label>
                        <input type="number" name="price" id="productprice" class="form-control" required value="{{$product[0]->price}}">
                     </div>
                     <div class="mb-3 form-check">
                        <label for="productcategory" class="form-label">Category</label>
                        
                        <select class="form-control" name="cat_id" id="productcategory" >
                        @if($category) @foreach($category as $val)
                        
                        <option value="{{$val->id}}" {{ $product[0]->cat_id==$val->id ?"selected": '' }}>{{$val->name}}</option>
                        
                        @endforeach @endif
                        </select>
                     </div>
                     <div class="mb-3 form-check">
                        <label for="productstatus" class="form-label">Status</label>

                        <select class="form-control" name="is_active" id="productstatus" >
                            <option value="1" {{ $product[0]->is_active==1 ?"selected": '' }}>Active</option>
                            <option value="0" {{ $product[0]->is_active==0 ?"selected": '' }}>In-Active</option>
                        </select>
                     </div>
                     <table class="table">
                        <tr>
                           <th>Title Image</th>
                           <td>
                           <input type="file" name="file" class="form-control hidd" id="product_title" >
                           
                           <img src="{{asset('/uploads/pages/'.$product[0]->file)}}" id="image" class="img_title"></td>

                           <td colspan="2"><button class="btn btn-primary" id="img_title">Replace</button></td>
                        </tr>
                        @isset($images) @foreach($images as $img)
                        <tr>
                           <th>Image {{$img->id}}</th>
                           <td><input type="file" name="product_img_{{$img->id}}" class="form-control hidd" id="product_img_{{$img->id}}" >
                              <img src="{{asset('uploads/pages/'.$img->file)}}" id="image" class="product_img_{{$img->id}}"></td>
                           <td><button class="btn btn-primary replace" id="{{$img->id}}">Replace</button></td>
                           <!-- <td> -->
                              <!-- <form action="{{ route('pro_img_destroy',$img->id) }}" method="DELETE" class="form-delete"> -->
                                 <!-- @method('DELETE') -->
                                 <!-- <button type="submit" class="btn btn-danger delete_button" onclick="return confirm('Are you sure you want to delete this Image?');">Delete</button> -->
                              <!-- </form> -->
                           <!-- </td> -->
                        </tr>
                        @endforeach @endisset

                     </table>
                     
                     <input type="submit" class="btn btn-primary" value="Submit" name="submit">
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
<link rel="stylesheet" href="{{asset('vendors/datatable/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('vendors/datatable/buttons/css/buttons.bootstrap4.min.css')}}"/>
<link rel="stylesheet" href="{{asset('vendors/x-editable/css/bootstrap-editable.css')}}" />
@endsection 

@section('script') 
<!-- END: Template JS-->

<script src="{{asset('vendors/x-editable/js/bootstrap-editable.min.js')}}"></script>
<script src="{{asset('js/xeditable.script.js')}}"></script>

<script src="{{asset('vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('vendors/datatable/jszip/jszip.min.js')}}"></script>
<script src="{{asset('vendors/datatable/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/datatable/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/datatable/buttons/js/buttons.print.min.js')}}"></script>

<script src="{{asset('js/datatable.script.js')}}"></script>
@endsection 

@section('css') 
<style>
   #image{
      width:100px !important;
   }
</style>
@endsection
 
@section('js') 
<script type="text/javascript">
   $(".hidd").hide();
   
   $(".replace").click(function(){
      event.preventDefault()
      var id = $(this).attr("id");
      $("#product_img_"+ id).show()
      $(".product_img_"+ id).hide()
      
   })
   
   $("#img_title").click(function(){
      event.preventDefault()
      $("#product_title").show();
      $(".img_title").hide();
   })

</script>
@endsection