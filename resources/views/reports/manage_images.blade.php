@extends('layouts.main') 
@section('content')
<!-- START: Card Data-->
<main>
   <div class="container-fluid site-width">
      <!-- START: Breadcrumbs-->
      <div class="row">
         <div class="col-12 align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
               <div class="w-sm-100 mr-auto">
                  <h4 class="mb-0">Image Pages</h4>
               </div>
               <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                  <li class="breadcrumb-item">Home</li>
                  <li class="breadcrumb-item">Report</li>
                  <li class="breadcrumb-item active"><a href="#">Custom Report</a></li>
               </ol>
            </div>
         </div>
      </div>
      <!-- END: Breadcrumbs-->
      <!-- START: Card Data-->
      <div class="row">
         <div class="col-12 mt-3">
            <div class="card">
               <div class="card-header justify-content-between align-items-center">
                  <h4 class="card-title"></h4>
                  <button class="btn btn-primary" id="add_page_images">Add Images</button>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                    
                     <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Image</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($img) @foreach($img as $val)
                           <tr>
                              <td>{{$val->id}}</td> 
                              <td><img src="{{asset('/uploads/pages/'.$val->file)}}" alt="" with="50px" id="page_img"></td>
                              @if($product) @foreach($product as $pro) @if($val->product_id==$pro->id)

                              @if($category) 
                              @foreach($category as $cat) 
                              @if($cat->id==$pro->cat_id)
                              <td>{{$cat->name}}</td>
                              @endif @endforeach @endif

                              <td>{{$pro->name}}</td>
                              @endif @endforeach @endif
                              <td>
                                 <button type="button" class="btn btn-primary edit_page" data-edit_id= "{{$val->id}}" data-file= "{{$val->file}}" data-product_id= "{{$val->product_id}}" data-status= "{{$val->is_active}}">Edit</button>
                              </td>
                           </tr>
                           @endforeach @endif
                        </tbody>
                        <tfoot>
                           <tr>
                           <th>ID</th>
                              <th>Path</th>
                              <th>Action</th>
                           </tr>
                        </tfoot>
                    </table>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- END: Card DATA-->
   </div>
</main>
<!-- Edit user modal -->
<div class="modal fade" id="exampleModalgrid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle3">ADD</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <form method="POST" action="{{route('add_page_images')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
         <div class="modal-body">
            <div class="container-fluid">
               <div class="container-fluid site-width">
                  <!-- START: Breadcrumbs-->
                  <div class="row">
                     <div class="col-12 align-self-center">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                           <div class="w-sm-100 mr-auto">
                              <h4 class="mb-0">Add Images</h4>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- END: Breadcrumbs-->
                  <!-- START: Card Data-->
                    
                      <div class="row">
                         <div class="col-12 mt-3">
                            <div class="card">
                               <div class="card-body">
                                  <table id="user" class="table table-bordered table-striped" style="clear: both;">
                                     <tbody>
                                        <tr>     
                                          <td class="w-50">Image</td>
                                          <td class="w-50">
                                            <input type="file" name="img" class="form-controll" >
                                            <img src="" alt="" id="image">
                                          </td>
                                        </tr>                                        
                                        <tr>
                                        <td class="w-50">Product</td>
                                        <td>
                                            <select name="product_id" id="product_id" class="form-control">
                                            @if($product)@foreach($product as $cat)

                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            
                                            @endforeach @endif
                                            </select></td>
                                        </tr>
                                        <tr>
                                           <td>Status</td>
                                           <td class="status">
                                           <select name='status' class='form-control input-sm'>
                                                <option value='1'>Active</option><option value='0' >In-Active</option></select>
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </div>
                            </div>
                         </div>
                      </div>
                    
                  <!-- END: Card DATA-->
               </div>
            </div>
         </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
   </div>
</div>

<!-- Edit user modal End-->
<!-- END: Card DATA-->
@endsection 
@section('link') 
@endsection 

@section('script') 
@endsection 

@section('css') 
<style type="text/css">
    #page_img{
        width:50px !important;
    }
    #image{
        width:40px !important;
    }
</style>
@endsection
 
@section('js') 
<script type="text/javascript">
    $("#image").hide();
    $("#cat_id").change(function(){

        var options = "";
        @if($product)
        @foreach($product as $cat)
        
        {{--@if($cat_id==$cat->cat_id)--}}
            option+="<option value='{{$cat->id}}'>{{$cat->name}}</option>";
        {{--@endif--}}
        @endforeach @endif
        
        $("#product_id").html(options)
    });

    $(".edit_page").click(function(){
        $("#image").attr("src","{{asset('/uploads/pages/')}}/"+$(this).data('file'));
        $("#image").show();
        $("#edit_id").val($(this).data('edit_id'));

        $("#exampleModalgrid").modal('show');

    })   
    
    $("#add_page_images").click(function(){
        $("#exampleModalgrid").modal('show');
    });

    $('#edit_active').click(function(){
        var body = "<select name='status' class='form-control input-sm'>";
        body += "<option value='1'>Active</option><option value='0'>In-Active</option>";
        body += " </select>";        
        $(this).closest("td").html(body);
    })

</script>
@endsection